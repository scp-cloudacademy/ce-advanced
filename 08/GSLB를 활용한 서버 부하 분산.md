<h1>GSLB를 활용한 서버 부하 분산</h1>
</br>
</br>
</br>

<h3>01. GSLB 생성</h3>

```baash
모든상품 > Networking > GSLB > 상품신청

용도 : PUBLIC
도메인명 : cosmeticsevolution
연결 대상 추가
 - IP : GSLB에 연결한 가상머신의 PUBLIC IP
 - 위치 : 가상머신 위치

부하 분산 정책 설정
 - 알고리즘 : Ratio

연결 대상 모니터링 설정
 - Health check : TCP
 - Interval : 5
 - Timeout : 60
 - Probe timeout : 5
 - Service port : 80
```

</br>

<h3>02. Security Group 규칙 추가</h3>

```bash
GSLB가 연결 대상을 모니터링하기 위해서는 Firewall 및 Security Group에 허용 규칙을 추가해야함

GSLB IP대역 (112.106.155.0/24, 112.107.100.0/24)
모니터링 서비스 포트
```




DR 서버 환경 구성

서버 NAT IP 연결

인터넷게이트웨이
인바운드 80
아웃바운드 80,443

SG
인바운드 80
아웃바운드 80,443
인바운드 112.106.155.0/24, 112.107.100.0/24   80

서버 접속 nginx 설치

GSLB  생성
서버 등록
Ratio 테스트






