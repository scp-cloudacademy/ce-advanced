<h1>다중_VPC간_Load_Balancer_구현</h1>
</br>
</br>
</br>

<h3>01. Load Balancer 생성</h3>

```bash
모든상품 > Networking > Load Balancer > 상품신청

Load Balancer명 : LBa
VPC : VPCa
크기 : SMALL
LB 서비스 IP대역 : 192.168.14.0/27
LB Link IP 대역 : 192.168.254.0/30    # 사용자지정으로 설정
FIrewall : 사용안함
Firewall로깅 : 사용안함
```

</br>

<h3>02. Internet Gateway Firewall 추가/수정</h3>

```bash
모든상품 > Networking > Firewall

Firewall명 : FW_IGW_VPCa
출발지 IP : 0.0.0.0/0
목적지 IP : 192.168.14.0/27
프로토콜 : TCP
허용포트 : 80
방향 : Inbound

Firewall명 : FW_IGW_VPCa
출발지 IP : 192.168.11.0/24
목적지 IP : 0.0.0.0/0
프로토콜 : TCP
허용포트 : 80,443
방향 : Outbound

Firewall명 : FW_IGW_VPCb
출발지 IP : 192.168.21.0/24
목적지 IP : 0.0.0.0/0
프로토콜 : TCP
허용포트 : 80,443
방향 : Outbound
```

</br>

<h3>03. Security Group 추가/수정</h3>

```bash
모든상품 > Networking > Security Group

Security Group명 : WebaSG
방향 : Inbound
대상주소 : 192.168.254.0/30
프로토콜 : TCP
허용 포트 : 80

Security Group명 : WebaSG
방향 : Outbound
대상주소 : 0.0.0.0/0
프로토콜 : TCP
허용 포트 : 80,443

Security Group명 : K8SBSG
방향 : Inbound
대상주소 : 192.168.254.0/30
프로토콜 : TCP
허용 포트 : 80

Security Group명 : K8SBSG
방향 : Outbound
대상주소 : 0.0.0.0/0
프로토콜 : TCP
허용 포트 : 80,443
```

</br>

<h3>04. NAT Gateway 생성</h3>

```bash
모든상품 > Networking > VPC > NAT Gateway > NAT Gateway 생성

VPC : VPCa
서브넷 : WEBa
NAT Gateway명 : -
NAT Gateway용 IP : 자동 할당

VPC : VPCb
서브넷 : K8Sb
NAT Gateway명 : -
NAT Gateway용 IP : 자동 할당
```

</br>

<h3>05. Nginx Install</h3>

weba1(192.168.11.2)및 b-testvm(192.168.21.2)에 접속

root password 설정
```bash
sudo passwd root
```
root 로그인

```bash
su root
```

입력

```bash
yum install yum-utils -y
systemctl stop httpd
vi /etc/yum.repos.d/nginx.repo
```

입력후 아래의 내용 Ctrl + C > Ctrl + V

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

Nginx Install

```bash
yum install nginx -y
```

Nginx start

```bash
systemctl enable nginx
systemctl start nginx
systemctl status nginx
```

Nginx 설정 파일 위치

```bash
vi /usr/share/nginx/html/index.html
```

</br>

<h3>06. VPC_Peering_Routing_Table 추가/수정</h3>

VPCb Routing Table에 LB Link IP 대역 추가

```bash
모든상품 > Networking > VPC > VPC Peering > Peer_VPCa_VPCb_9

Routing_Table_VPCb : 192.168.254.0/30 (LB Link IP 대역)
```

</br>

<h3>07. LB 서버 그룹 생성</h3>

```bash
모든상품 > Networking > Load Balancer > LB 서버그룹 > LB 서버그룹 생성

Load Balancer 선택 : LBa
서버그룹명 : CrossVPCLBtest
부하분산 : Round robin
대상서버 : weba1(192.168.11.2), b-testvm(192.168.21.2)
헬스체크 : 프로토콜 (TCP), 헬스체크포트 (80), 나머지 기본값 설정
HTTP 1.1 : 사용
```

</br>

<h3>08. LB 서비스 생성</h3>

```bash
모든상품 > Networking > Load Balancer > LB 서비스 > LB 서비스 생성

Load Balancer 선택 :
서비스명 : CrossVPCLBtest
서비스 IP : 신규 IP 할당
서비스 구분 : L4 / TCP
서비스 포트 : 80
전달 포트 : 80
NAT IP : 사용
서버그룹 : CrossVPCLBtest
프로파일 : 기본값
액세스 로그저장 : 사용안함 
```
