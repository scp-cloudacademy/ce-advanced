<h1>GSLB를 활용한 서버 부하 분산</h1>
</br>
</br>
</br>

<h3>01. GSLB 생성</h3>

```baash
모든상품 > Networking > GSLB > 상품신청

용도 : PUBLIC
도메인명 : gslbtestce
연결 대상 추가
 - IP : 123.37.4.75(drtest), 123.41.128.11(bastiondr)    # GSLB에 연결한 가상머신의 PUBLIC IP
 - 위치 : 가상머신 위치

부하 분산 정책 설정
 - 알고리즘 : Ratio

연결 대상 모니터링 설정
 - Health check : TCP
 - Interval : 5
 - Timeout : 7
 - Probe timeout : 5
 - Service port : 80
```

</br>

<h3>02. IGW_Firewall_추가/수정</h3>

GSLB가 연결 대상을 모니터링하기 위해서는 Firewall 및 Security Group에 허용 규칙을 추가해야함

```bash
모든상품 > Networking > Firewall

FIrewall명 : FW_IGW_VPCdrtest
출발지 IP : 112.106.155.0/24, 112.107.100.0/24
목적지 IP : 192.168.1.0/24
프로토콜 : TCp
허용포트 : 80
방향 : Inbound

FIrewall명 : FW_IGW_VPCdr
출발지 IP : 112.106.155.0/24, 112.107.100.0/24
목적지 IP : 192.168.30.0/24
프로토콜 : TCp
허용포트 : 80
방향 : Inbound

```

</br>

<h3>03. Security Group 규칙 추가/수정</h3>

GSLB가 연결 대상을 모니터링하기 위해서는 Firewall 및 Security Group에 허용 규칙을 추가해야함

```bash
모든상품 > Networking > Security Group

Security Group명 : drtestSG
방향 : Inbound
대상 주소 : 112.106.155.0/24, 112.107.100.0/24
프로토콜 : TCP
허용 포트 : 80

Security Group명 : BASTIONdrSG
방향 : Inbound
대상 주소 : 112.106.155.0/24, 112.107.100.0/24
프로토콜 : TCP
허용 포트 : 80 
``` 
