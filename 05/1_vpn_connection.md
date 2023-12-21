# IPSec VPN Connection

## Prerequisition
VMware Workstation Pro </br>

## 01. Create VM for VPN on Workstation Pro

- clone VM from VM Image
- name: vpnvm

## 02. Enable and open ports on VM firewall

```bash
systemctl status firewalld
systemctl start firewalld
systemctl enable firewalld
firewall-cmd --zone=public --add-port=22/tcp --permanent
firewall-cmd --reload
firewall-cmd --list-ports
```

## 03. Install strongswan on On-premise VM

```bash
sudo yum install epel-release
sudo yum install strongswan
```

## 04. Request VPN service on Samsung Cloud Platform

All products > Network > VPN, Request VPN

```bash
VPN Gateway name : VPNce
QoS 대역폭 : 10 Mbps
Public IP : Auto allocated	      	
Local subnet(CIDR): 192.168.5.0/24	        # IP band for Local subnet
```

</br>

## 05. Request Samsung Cloud Platform VPN Tunnel

```bash
# Type in information below
VPN Gateway : VPNce
VPN Tunnel명 : VPNTunnelce
Peer VPN GW IP : My PC Public IP  		# VMware Public IP (Google - What is my ip)
Local tunnel IP : 169.254.200.6/30		# IP address to VPN Tunnel interface
Peer tunnel IP : Auto Configued			# 상대방 VPN Gateway의 VPN Tunnel 인터페이스에 할당하는 IP 주소
Remote subnet :  [Local PC VM IP band]        	# Local VM IP band(example, 192.168.139.0/24) 
Pre-shared key : 8-64 characters         	# Shared key to authenticate connection between VPN Gateway

# additional IKE configuration
IKE version : IKE_V2
Encryption algorithm : AES_256
Digest algorithm : SHA2_256
Diffie-hellman : GROUP2
SA lifeTime(sec.) : 86400

# additional IPSEC configuration
Encryption algorithm : AES_256
Digest algorithm : SHA2_256
PFS group : USE
Diffie-hellman : GROUP2
SA lifeTime(sec.) : 3600
DF bit : COPY

# addtional DPD configuration
DPD probe interval(sec.) : 60

# etc. configuration
Connection initiation mode : INITIATOR
TCP MSS clamping : UNUSED
TCP MSS direction : OUTBOUND_CONNECTION
TCP MSS value : AUTO
```

</br>

## 06. Configure On-premise VM packet forwarding

```bash
vi /etc/sysctl.conf				

net.ipv4.ip_forward = 1 			
net.ipv4.conf.all.accept_redirects = 0 		
net.ipv4.conf.all.send_redirects = 0		
```

After exiting vi, type command

```
sysctl -p 					
```

</br>

## 07. Configure On-premise VM VPN 

```bash
vi /etc/strongswan/ipsec.conf		

config setup
	strictcrlpolicy=yes
	uniqueids = no
	charondebug="cfg 2, ike 2, knl 2"

conn SCP-VPN
	left=[CentOS Private IP]  		
	leftid=[My PC Public IP]		# Google What is my IP
	right=123.37.255.139			# VPN Public IP (can check Samsung Cloud Platform VPN detail - Public IP) 
	rightsubnet=192.168.50.0/24	 	# Samsung Cloud Platform Local Subnet IP band(Samsung Cloud Platform VPN detail - Local Subnet) 
	leftsubnet=[CentOS Private IP band]       
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

## 08. Confogure On-premise VM VPN connection

```bash
vi /etc/strongswan/ipsec.secrets	
```
Type in the infomation below

예시) 192.168.45.131 123.37.255.139 121.166.171.190 : PSK "abcde1234"

```
[VMware Private IP]  [VPN Public IP] [Local Public IP] : PSK "Password"
```

</br>

## 09. On-premise VM IPSec connection and debugging

```bash
strongswan start
```
Type command. if it doesn't work, reboot and retry.
```
strongswan statusall	
```

</br>

## 10. Add Samsung Cloud Platform Security Group rule

```bash
  Inbound : 3389,22 Port (CentOS Private IP)	# [VMware Public IP],[VMware Private IP]
```

</br>

## 11. Connect Samsung Cloud Platform VPN to Virtual Server(Linux)

Check networking information at Virtual Server 

```bash
ifconfig
```
Example,

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
All products > Networking > VPN > VPN > VPNce > Local Subnet > Create VPN connection > Select Virtual Server 	

In the Virtual Server,

```bash
ifconfig
```
you can see new connection.

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

## 12. Configure Virtual Server networking(Linux)

Configure Routing

</br>

example) sudo vi /etc/sysconfig/network-scripts/ifcfg-ens224

```
sudo vi /etc/sysconfig/network-scripts/ifcfg-[created adapter name above]
```

```
TYPE=Ethernet
BOOTPROTO=static
IPADDR=[allocated IP from Local Sunbet] (example, 10.100.10.2)
PREFIX=24
NAME=ens224
DEVICE=ens224
ONBOOT=yes
```
</br>

## 12-2. Configure Samsung Cloud Platform network routing

</br>

example) vi /etc/sysconfig/network-scripts/route-ens224

```
sudo vi /etc/sysconfig/network-scripts/route-[created adapter name above]
```
add information below

example) 192.168.139.0/24 via 10.100.0.1
```bash
[CentOS Subnt IP band] via [SCP VPN Gateway IP(VPN-Local Sunbet, can check SCP console)]
```
Type command
```
sudo systemctl restart network
```
Check configuration
```bash
ip addr
ip route
```
</br>

## 12-3. Configure and Test connection between On-premise VMs</h3>

</br>

On VM,

example) ip route add 10.100.0.0/24 via 192.168.139.129
```
ip route add [SCP Local Subnet IP band] via [Strongswan VPN VM's Private IP]
ip route
ssh vmuser@[SCP Virtual Server Local Subnet IP]
```

</br>

## 12-4. Test connection on Local PC(Powershell)

</br>

example) route add 10.100.0.0 MASK 255.255.255.0 192.168.139.1 METRIC 1

```
route add [SCP Local Subnet IP band] MASK 255.255.255.0 [VMware Virtual Adapter IP address on Windows]  METRIC 1
route print
```

</br>








