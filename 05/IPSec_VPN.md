- 사전 구성 환경 </br>
VMware Workstation Pro 설치</br>
실습 PC의 VMware Workstation Pro에서 신규 VM 생성
</br>

<h3>01. On-premise VM 방화벽 활성화</h3>



```bash

systemctl status firewalld
systemctl start firewalld
systemctl enable firewalld
```

</br>

<h3>02. On-premise VM Port오픈</h3>

```bash
firewall-cmd --zone=public --add-port=3389/tcp --permanent
firewall-cmd --zone=public --add-port=22/tcp --permanent
firewall-cmd --reload
firewall-cmd --list-ports
```
</br>

<h3>03. On-premise VM strongswan 설치</h3>

```bash
sudo yum install epel-release
sudo yum install strongswan
```

</br>


<h3>04. Samsung Cloud Platform VPN 생성</h3>
모든 상품 - Networjing - VPN - VPN 에서 상품 신청

```bash
VPN Gateway명 : VPNce
QoS 대역폭 : 10 Mbps
Public IP : 자동 할당	         	# VPN 에서 사용하는 Public IP
Local subnet IP : 10.100.0.0/24	        # VPN Gateway가 사용할 Local subnet 대역
```

</br>

<h3>05. Samsung Cloud Platform VPN Tunnel 생성</h3>

```bash
# 필수 정보 입력
VPN Gateway : VPNce
VPN Tunnel명 : VPNTunnelce
Peer VPN GW IP : My PC Public IP  		# VMware Public IP (Google - What is my ip)
Local tunnel IP : 169.254.200.6/30		# VPN Tunnel 인터페이스에 할당하는 IP 주소
Peer tunnel IP : 자동 설정			# 상대방 VPN Gateway의 VPN Tunnel 인터페이스에 할당하는 IP 주소
Remote subnet :  직접 입력        		# Local VM에서 $ Ip addr 실행 후 Broadcast 에 사용하는 nic의 inet 정보 기입(예, inet 192.168.139.0/24 
Pre-shared key : 8-64자리 영숫자 임의 설정 	# VPN Gateway간 IKE 상호 인증에 사용할 공유키

# IKE 추가 설정
IKE version : IKE_V2
Encryption algorithm : AES_256
Digest algorithm : SHA2_256
Diffie-hellman : GROUP2
SA lifeTime(sec.) : 86400

# IPSEC 추가 설정
Encryption algorithm : AES_256
Digest algorithm : SHA2_256
PFS group : USE
Diffie-hellman : GROUP2
SA lifeTime(sec.) : 3600
DF bit : COPY

# DPD 추가 설정
DPD probe interval(sec.) : 60

# 기타 설정
Connection initiation mode : INITIATOR
TCP MSS clamping : UNUSED
TCP MSS direction : OUTBOUND_CONNECTION
TCP MSS value : AUTO
```

</br>

<h3>06. On-premise VM 패킷 포워딩 활성화 설정</h3>

```bash
vi /etc/sysctl.conf				# 경로

net.ipv4.ip_forward = 1 			# IP포워딩 활성화 (리눅스 시스템이 다른 네트워크로 패킷을 전달 할 수 있게 도와줌)
net.ipv4.conf.all.accept_redirects = 0 		# ICMP Redirect 메시지를 수락하지 않도록 설정 (보안강화 및 중간자 공격을 방지)
net.ipv4.conf.all.send_redirects = 0		# ICMP Redirect 메시지를 보내지 않도록 설정 (보안강화)
```
Esc 입력 후 wq! 로 Vi 저장 후 나옴.
```
sysctl -p 					# 설정값 적용
```

</br>

<h3>07. On-premise VM VPN 환경 설정</h3>

```bash
vi /etc/strongswan/ipsec.conf		# 경로

config setup
	strictcrlpolicy=yes
	uniqueids = no
	charondebug="cfg 2, ike 2, knl 2"

conn SCP-VPN
	left=CentOS Private IP  		# CentOS에서 $ifconfig 조회
	leftid=My PC Public IP			# Google What is my IP
	right=123.37.255.139			# VPN Public IP (SCP VPN 콘솔 상세정보에서 Public IP 확인) 
	rightsubnet=192.168.50.0/24	 	# SCP Local Subnet IP 대역(SCP VPN 콘솔 상세정보에서 Local Subnet 확인) 
	leftsubnet=CentOS Private IP대역	# CentOS에서 $ifconfig 조회
	ike=aes256-sha256-modp1024!
	keyexchange=ikev2
	reauth=yes
	ikelifetime=86400s
	dpddelay=15s
	dpdtimeout=60s
	dpdaction=restart
	closeaction=none
	esp=aes256-sha256-modp1024!
	keylife=3600s
	rekeymargin=540s
	type=tunnel
	compress=no
	authby=secret
	auto=start
	keyingtries=%forever
```

</br>

<h3>08. On-premise VM VPN 연결 정보 설정</h3>

```bash
vi /etc/strongswan/ipsec.secrets	# 경로
```
vi 에서 아래의 정보를 순서대로 추가

예시) 192.168.45.131 123.37.255.139 121.166.171.190 : PSK "abcde1234"

```
[VMware Private IP]  [VPN Public IP] [Local Public IP] : PSK "Password"
```

</br>

<h3>09. On-premise VM IPSec 연결 및 디버깅</h3>

```bash
strongswan start
```
아래의 명령어로 연결 확인, 연결이 안되었을 경우 reboot 실행
```
strongswan statusall	
```

</br>

<h3>10. Samsung Cloud Platform Security Group 규칙 추가/수정</h3>

```bash
  Inbound : 3389,22 Port (CentOS Private IP)	# [VMware Public IP],[VMware Private IP]
```

</br>

<h3>11. Samsung Cloud Platform VPN에 Virtual Server 연결(Linux)</h3>

SCP에서 VPN 연결할 Virtual Server에 SSH 접속해서 아래의 명령어로 네트워크 정보 확인

```bash
ifconfig
```
일반적으로 두개의 네트워크 연결이 보여짐.
예시

```
ens192: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 192.168.0.6  netmask 255.255.255.0  broadcast 192.168.0.255
        inet6 fe80::250:56ff:fe94:636b  prefixlen 64  scopeid 0x20<link>
        ether 00:50:56:94:63:6b  txqueuelen 1000  (Ethernet)
        RX packets 13547  bytes 106599545 (101.6 MiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 11721  bytes 29749541 (28.3 MiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

lo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536
        inet 127.0.0.1  netmask 255.0.0.0
        inet6 ::1  prefixlen 128  scopeid 0x10<host>
        loop  txqueuelen 1000  (Local Loopback)
        RX packets 0  bytes 0 (0.0 B)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 0  bytes 0 (0.0 B)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
```
상태 확인 후 모든상품 > Networking > VPN > VPN > VPNce 선택[배포되어있는 VPN] > Local Subnet > VPN 연결 추가 > Virtual Server 연결	

VPN 연결 추가시 가상머신 내부에 새로운 Ethernet이 생성
다시 아래의 명령어로 네트워크 상태 확인

```bash
ifconfig
```
아래와 같이 2개에서 3개의 네트워크 구성 정보가 나타남

```
ens192: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 192.168.0.6  netmask 255.255.255.0  broadcast 192.168.0.255
        inet6 fe80::250:56ff:fe94:636b  prefixlen 64  scopeid 0x20<link>
        ether 00:50:56:94:63:6b  txqueuelen 1000  (Ethernet)
        RX packets 13583  bytes 106602199 (101.6 MiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 11756  bytes 29771996 (28.3 MiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

ens224: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet6 fe80::807:e6fe:c233:7e54  prefixlen 64  scopeid 0x20<link>
        ether 00:50:56:94:9e:82  txqueuelen 1000  (Ethernet)
        RX packets 22  bytes 1620 (1.5 KiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 13  bytes 1614 (1.5 KiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0

lo: flags=73<UP,LOOPBACK,RUNNING>  mtu 65536
        inet 127.0.0.1  netmask 255.0.0.0
        inet6 ::1  prefixlen 128  scopeid 0x10<host>
        loop  txqueuelen 1000  (Local Loopback)
        RX packets 0  bytes 0 (0.0 B)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 0  bytes 0 (0.0 B)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
```

</br>

<h3>12. 연결된 Virtual Server 내부 설정(Linux 설정)</h3>

가상 머신연결 후 새로 생성된 어댑터의 네트워크 및 라우팅 설정이 필요함

</br>

<h3>12-1. Samsung Cloud Platform 이더넷 네트워크 설정</h3>

</br>

예시) sudo vi /etc/sysconfig/network-scripts/ifcfg-ens224

```
sudo vi /etc/sysconfig/network-scripts/ifcfg-[새로 생성된 네트워크 어댑터 명]
```

```
TYPE=Ethernet
BOOTPROTO=static
IPADDR=[Local Sunbet에서 할당 받은 IP] (예, 10.100.10.2)
PREFIX=24
NAME=ens224
DEVICE=ens224
ONBOOT=yes
```
</br>

<h3>12-2. Samsung Cloud Platform 네트워크 라우팅 설정</h3>

</br>

예시) vi /etc/sysconfig/network-scripts/route-ens224

```
sudo vi /etc/sysconfig/network-scripts/route-[새로 생성된 네트워크 어댑터 명]
```
아래의 항목을 추가

예시) 192.168.139.0/24 via 10.100.0.1
```bash
[CentOS Subnt 대역] via [SCP VPN Gateway IP(VPN-Local Sunbet에서 조회)]
```
```
네트워크 재설정 명령

systemctl restart network
```
</br>

<h3>12-3. On-premise의 다른 VM에서 원격접속 설정</h3>

</br>

VM에서 다음 명령어 입력

예시) ip route add 10.100.0.0/24 via 192.168.139.129
```
ip route add [SCP Local Subnet IP 대역] via [Strongswan VPN을 구성한 VM의 Private IP]
ip route
ssh vmuser@[SCP에 VPN 연결한 Virtual Server의 Local Subnet IP]
```

</br>

<h3>12-4. Local PC에서 테스트(Powershell 관리자 모드로 실행)</h3>

</br>

예시) route add 10.100.0.0 MASK 255.255.255.0 192.168.139.1 METRIC 1

```
route add [SCP Local Subnet IP 대역] MASK 255.255.255.0 [Windows 네트워크 환경에서 확인한 VMware Virtual Adapter IP 주소]  METRIC 1
route print
```

</br>

<h3>13. 연결된 Virtual Server 내부 설정(Windows Server 설정)</h3>

가상 머신연결 후 새로 생성된 어댑터의 네트워크 및 라우팅 설정이 필요함

</br>

<h3>13-1. 새로 생성된 어댑터 네트워크 설정</h3>

</br>

```bash
1. c:\> ipconfig/all	# VPN용 네트워크 어댑터 정보를 확인(VPN 연결 추가시 새로 생성됨)
2. Search > Control Panel > Network and internet > Network and sharing Center > Change adapter settings > VPN용 어댑터 확인 후 속성
3. 인터넷 프로토콜 버전 4(TCP/IPv4) 속성
4. Use the follwing IP address
	IP address	: 192.168.50.2	# VPN에 연결된 Local Subnet IP
	Subnet mask	: 255.255.255.0	# Subnet mask
	Default Gateway	: 공백
```

</br>

<h3>13-2. 라우팅 설정</h3>

</br>

CMD창에서 다음 명령어 입력

예시) route add 192.168.139.0 mask 255.255.255.0 10.100.0.1
```bash
route add [CentOS Subnt 대역] MASK 255.255.255.0 [SCP VPN Gateway IP(VPN-Local Sunbet에서 조회)]
```

</br>

<h1>VMware</h1>
</br>
</br>
</br>

<h3>14. Linux -> Windows RDP 연결 환경 세팅</h3>

```bash
# GUI GroupInstall
sudo yum groups list | grep -i desktop
   Cinnamon Desktop
   MATE Desktop
   GNOME Desktop
   General Purpose Desktop
   LXQt Desktop

# GNOME이 제대로 설치되지 않을 경우 "Server with GUI" 그룹을 설치
sudo yum groupinstall "GNOME Desktop"

# GUI init
systemctl get-default
systemctl set-default graphical.target
systemctl get-default

# 재부팅
reboot
```

</br>

<h3>15. 원격 접속 설정</h3>

```bash
# XRDP Install
sudo yum install epel-release
sudo yum install xrdp
sudo systemctl enable xrdp && systemctl start xrdp
```

</br>

<h3>16. rdesktop 설치</h3>

```bash
# 컴파일러와 openssl-devel 이 패키지 컴파일 선행조건입니다.
 yum -y install gcc openssl-devel
 wget https://github.com/rdesktop/rdesktop/releases/download/v1.8.6/rdesktop-1.8.6.tar.gz
 tar xvzf rdesktop-1.8.6.tar.gz
 cd rdesktop-1.8.6/
 ./configure --disable-credssp --disable-smartcard
 make 
 make install
```

<h3>17. VMware -> Virtual Server 접속</h3>

```bash
rdesktop -u vmuser 192.168.50.2	# rdesktop -u [User] [ip]
```








