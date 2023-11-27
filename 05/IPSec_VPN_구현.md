<h1>VMware</h1>
</br>
</br>
</br>

<h3>00. VMwaare 생성</h3>

</br>

<h3>01. 방화벽 활성화</h3>

```bash
sudo 
sudo systemctl status firewalld
sudo systemctl start firewalld
sudo systemctl enable firewalld
```

</br>

<h3>02. Port오픈</h3>

```bash
sudo firewall-cmd --zone=public --add-port=3389/tcp --permanent
sudo firewall-cmd --reload
sudo firewall-cmd --list-ports
```
</br>

<h3>03. strongswan 설치</h3>

```bash
sudo yum install epel-release
sudo yum install strongswan
```

</br>

<h1>SCP Console</h1>
</br>
</br>
</br>

<h3>04. VPN 생성</h3>

```bash
VPN Gateway명 : VPNce
QoS 대역폭 : 10 Mbps
Public IP : 123.37.255.139		# VPN 에서 사용하는 Public IP
Local subnet IP : 192.168.50.0/24	# VPN Gateway가 사용할 Local subnet 대역
```

</br>

<h3>05. VPN Tunnel 생성</h3>

```bash
# 필수 정보 입력
VPN Gateway : VPNce
VPN Tunnel명 : VPNTunnelce
Peer VPN GW IP : 121.166.171.190  	# VMware Public IP
Local tunnel IP : 169.254.200.6/30	# VPN Tunnel 인터페이스에 할당하는 IP 주소
Peer tunnel IP : 169.254.200.5		# 상대방 VPN Gateway의 VPN Tunnel 인터페이스에 할당하는 IP 주소
Remote subnet : 192.168.45.0/24   	# VMware Subnet IP대역
Pre-shared key :			# VPN Gateway간 IKE 상호 인증에 사용할 공유키

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

<h1>VMware</h1>
</br>
</br>
</br>

<h3>06. 패킷 포워딩 활성화 설정</h3>

```bash
vi /etc/sysctl.conf				# 경로

net.ipv4.ip_forward = 1 			# IP포워딩 활성화 (리눅스 시스템이 다른 네트워크로 패킷을 전달 할 수 있게 도와줌)
net.ipv4.conf.all.accept_redirects = 0 		# ICMP Redirect 메시지를 수락하지 않도록 설정 (보안강화 및 중간자 공격을 방지)
net.ipv4.conf.all.send_redirects = 0		# ICMP Redirect 메시지를 보내지 않도록 설정 (보안강화)

sysctl -p 					# 설정값 적용
```

</br>

<h3>07. VPN 환경 설정</h3>

```bash
vi /etc/strongswan/ipsec.conf		# 경로

config setup
	strictcrlpolicy=yes
	uniqueids = no
	charondebug="cfg 2, ike 2, knl 2"

conn SCP-VPN
	left=192.168.45.131		# VMware Private IP
	leftid=121.166.171.190		# Local Public IP
	right=123.37.255.139		# VPN Public IP
	rightsubnet=192.168.50.0/24	# VPN Local Subnet (CIDR)
	leftsubnet=192.168.45.0/24   	# VMware Subnet IP
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

<h3>08. VPN 환경 설정</h3>

```bash
vi /etc/strongswan/ipsec.secrets	# 경로

192.168.45.131 123.37.255.139 121.166.171.190 : PSK "########"
[VMware Private IP]  [VPN Public IP] [Local Public IP] : PSK "Password"
```

</br>

<h3>09. IPSec 연결 및 디버깅</h3>

```bash
strongswan start
strongswan statusall	# 연결이 안될경우 reboot
```

</br>

<h1>SCP Console</h1>
</br>
</br>
</br>

<h3>10. Security Group 규칙생성</h3>

```bash
  Inbound : 3389 Port (121.166.171.190,192.168.45.131)	# [VMware Public IP],[VMware Private IP]
```

</br>

<h3>11. VPN에 Virtual Server 연결</h3>

```bash
모든상품 > Networking > VPN > VPN > VPNce 선택[배포되어있는 VPN] > Local Subnet > VPN 연결 추가 > Virtual Server 연결	# VPN 연결 추가시 가상머신 내부에 새로운 Ethernet이 생성됨
```

</br>

<h3>12. 연결된 Virtual Server 내부 설정</h3>

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

<h1>VMware</h1>
</br>
</br>
</br>

<h3>13. Linux -> Windows RDP 연결 환경 세팅</h3>

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

<h3>14. 원격 접속 설정</h3>

```bash
# XRDP Install
sudo yum install epel-release
sudo yum install xrdp
sudo systemctl enable xrdp && systemctl start xrdp
```

</br>

<h3>15. rdesktop 설치</h3>

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

<h3>16. VMware -> Virtual Server 접속</h3>

```bash
rdesktop -u vmuser 192.168.50.2	# rdesktop -u [User] [ip]
```








