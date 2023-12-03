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
LB 서비스 IP대역 : 192.168.5.0/27
LB Link IP 대역 : 192.168.254.28/30    # 사용자지정으로 설정
FIrewall : 사용안함
Firewall로깅 : 사용안함
```

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





















