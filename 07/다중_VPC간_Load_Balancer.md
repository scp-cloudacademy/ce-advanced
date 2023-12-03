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
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>






<h3>02. LB서비스 생성</h3>

```bash
모든상품 > Networking > Load Balancer > LB서비스 > LB 서비스 생성

Load Balanceer 선택 : LBa
서비스명 : LBSERVICEa
서비스 IP : 신규 IP할당
서비스 구분 : L7(HTTP)
서비스 포트 : 80
전달 포트 : 80
NAT IP : 사용
URL 처리 : 기본값
프로파일 : 기본값
액세스 로그저장 : 사용안함
```

</br>

<h3>03. LB서버그룹 생성</h3>

```baash
모든상품 > Networking > Load Balancer > LB서비스 > LB 서버그룹 생성

Load Balancer 선택 : LBa
서버그룹명 : LBSERVICEGROUPa
부하분산 : Round robin
1. 대상서버 : weba1, 프로토콜 TCP, 헬스체크포트 80, 나머지기본값
2. 대상서버 : 192.168.21.2(TestVM Private IP), 프로토콜 TCP, 헬스체크포트 80, 나머지기본값
HTTp1.1 : 사용

# 생성 후 LB서비스에 서버그룹 등록
```

</br>

<h3>04. Security Group 규칙 추가</h3>

```bash
WEBaSG (VPCa)
    - Inbound  : 80 (LB Link IP)
    - Outbound : 0.0.0.0/0

K8SbSG (VPCb)
    - Inbound  : 80 (LB Link IP)
    - Outbound : 0.0.0.0/0
```

</br>

<h3>05. VPC Peering 규칙 추가</h3>

```bash
: VPCa <--Peering--> VPCb
 Routing_Table_VPCa : 추가설정 x
 Routing_Table_VPCb : 192.168.254.28/30 # VPCb -> LB로가는 라우팅설정
```

</br>

<h3>아파치 설치 명령어</h3>

```bash
sudo yum update
sudo yum install httpd
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl status httpd
```

</br>

<h3>방화벽 설정</h3>

```bash
sudo systmectl status firewalld
sudo systmectl start firewalld
sudo systmectl enable firewalld

sudo firewall-cmd --zone=public --add-port=80/tcp --permanent
sudo firewall-cmd --reload

sudo firewall-cmd --list-all
```




[Load Balancer]
LBa 
192.168.14.0/27
Link IP 
192.168.254.0/30

[Inetnet Gateway Firewall] 
VPCa lb Service IP 80 S: 0.0.0.0/0 t:192.168.14.0/27
       IGW_FW 80,443 outbound S: 192.168.11.0/24 0.0.0.0/0 허용
 
VPCb IGW_FW 80,443 outbound S: 192.168.21.0/24 0.0.0.0/0 허용

[Security Group]
WebaSG 0.0.0.0/0 80,443 outbound 허용
           192.168.254.0/30 inbound 허용
WebaSG 0.0.0.0/0 80,443 outbound 허용
           192.168.254.0/30 inbound 허용            

NAT Gateway

Remote 접속
Web Server Nginx 설치 진행
VPCa Server
VPCb Server

[VPC Peering]
VPCB의 라우팅테이블에 LB Link IP 대역 등록


[Load Balancer]
LB 서버그룹 구성
LB 서비스 구성

테스트





















