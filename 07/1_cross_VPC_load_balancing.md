# Cross VPC load balancing
</br>

## 01. Create Load Balancer

```bash
All products > Networking > Load Balancer > Request

Load Balancer명 : LBa
VPC : VPCa
Size : SMALL
LB Service IP: 192.168.14.0/27
LB Link IP : 192.168.254.0/30    # Custom (with other VPC servers)
```

</br>

## 02. Add Internet Gateway Firewall rules

```bash
All products > Networking > Firewall

Firewall name : FW_IGW_VPCa
Source IP : 0.0.0.0/0
Destination IP : 192.168.14.0/27
Protocol : TCP
Allowed port : 80
Direction : Inbound

Firewall name : FW_IGW_VPCa
Source IP : 192.168.11.0/24
Destination IP : 0.0.0.0/0
Protocol : TCP
Allowed port : 80,443
Direction : Outbound

Firewall name : FW_IGW_VPCb
Source IP : 192.168.21.0/24
Destination IP : 0.0.0.0/0
Protocol : TCP
Allowed port : 80,443
Direction : Outbound
```

</br>

## 03. Add Security Group rule

```bash
All products > Networking > Security Group

Security Group명 : WebaSG
Direction : Inbound
Target IP : 192.168.254.0/30
Protocol : TCP
Alowed port : 80

Security Group명 : WebaSG
Direction : Outbound
Target IP : 0.0.0.0/0
Protocol : TCP
Alowed port : 80,443

Security Group명 : K8SBSG
Direction : Inbound
Target IP : 192.168.254.0/30
Protocol : TCP
Alowed port : 80

Security Group명 : K8SBSG
Direction : Outbound
Target IP : 0.0.0.0/0
Protocol : TCP
Alowed port : 80,443
```

</br>


## 04. Create NAT Gateway

```bash
All products > Networking > VPC > NAT Gateway > Create NAT Gateway 

VPC : VPCa
Subnet : WEBa
NAT Gateway name : -
NAT Gateway IP : Automatic Allocation

VPC : VPCb
Subnet : K8Sb
NAT Gateway name : -
NAT Gateway IP : Automatic Allocation
```

</br>

## 05. Install Nginx on Virtual Server

SSH connection to weba1(192.168.11.2) and b-testvm(192.168.21.2)

set root password
```bash
sudo passwd root
```
change account to root 

```bash
su root
```

Type commands,

```bash
yum install yum-utils -y
systemctl stop httpd
vi /etc/yum.repos.d/nginx.repo
```

Copy and paste below information

```bash
[nginx-stable]
name=nginx stable repo
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/
gpgcheck=1
enabled=1
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true

[nginx-mainline]
name=nginx mainline repo
baseurl=http://nginx.org/packages/mainline/centos/$releasever/$basearch/
gpgcheck=1
enabled=0
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true
```

Install Nginx 

```bash
yum install nginx -y
```

Start Nginx

```bash
systemctl enable nginx
systemctl start nginx
systemctl status nginx
```

Change index.html 

```bash
vi /usr/share/nginx/html/index.html
```

</br>

## 06. Add VPC_Peering_Routing_Table

Add LB Link IP on VPCb Routing Table

```bash
All products > Networking > VPC > VPC Peering > Peer_VPCa_VPCb_9

Routing_Table_VPCb : 192.168.254.0/30 (LB Link IP band)
```

</br>

## 07. Create LB server group

```bash
All products > Networking > Load Balancer > LB server group > create LB server group

Load Balancer : LBa
Server Group name : CrossVPCLBtest
Algorithm : Round robin
Target Server : weba1(192.168.11.2), b-testvm(192.168.21.2)
Health check : protocol (TCP), Health check port (80)
HTTP 1.1 : use
```

</br>

## 08. Create LB Service

```bash
All products > Networking > Load Balancer > LB service > Create LB Service

Load Balancer :
Service name : CrossVPCLBtest
Service IP : New IP Allocation
Service Category : L4 / TCP
Service port : 80
Forwading port : 80
NAT IP : use
Server Group : CrossVPCLBtest
```
