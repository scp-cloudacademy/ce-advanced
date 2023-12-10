
# 1. Create Certificates

### 인증서 발급을 위한 서버 생성
Public Subnet(WEBa)에 NAT IP가 연결된 CentOS Virtual Server를 생성
```
sudo yum install httpd -y
```
### NAT IP를 DNS에 등록
```
cosmeticevolution.net   # apps.cosmeticevolution.net는 각자 등록한 도메인으로 설정
Record A : apps   NAT IP
```

### Virtual Server에서 다음 명령어 실행 

#### 1) 레포지토리 조회
```
sudo yum repolist | grep epel
```
* 조회가 안되는 경우 설치
  ```
  sudo yum -y install epel-release
  ```
#### 2) Certbot 설치
```
sudo yum install certbot python2-certbot-apache -y
```

###### ※ 인증서는 절차가 간소한 standalone 방식으로 발급하며, 발급 전 웹서버 서비스를 잠시 중지시켜야 한다.
```
sudo systemctl stop nginx
```

#### 3) 인증서 발급
아래 명령어 실행 전에 IGW FW, SG에 80 Inbound 개방 여부 확인
```
sudo certbot certonly --standalone -d apps.cosmeticevolution.net # apps.cosmeticevolution.net는 각자 등록한 도메인으로 설정
```
첫째 질문, 메일 주소 질문 : 메일 주소 입력
둘째 질문, ACME 서버 등록 여부 확인 : 반드시 Y
셋째 질문, 메일 주소 공유 질문 : Y 또는 N 선택

발급 완료 후 인증서 확인 및 저장 위치 이동(root 권한 필요)

```
sudo cd /etc/letsencrypt/archive/devops.cosmeticevolution.net
```

#### 4) 인증서 관리에 인증서 등록
상품 신청 
인증서명 : cedevops_cosmeticevolution_net
용도 : 운영
인증서 등록
Private Key : privkey1.pem      # 서버에서 받은 인증서
Certificate body: fullchain1.pem     # 서버에서 받은 인증서
Certificate chain: intermediate / Root  #Letsencrypt 사이트에서 받은 Root와 Intermediate pem 인증서

# 2. Load Balancer LB Group/Service 생성 서비스 443, 배포 ingress 의 443 포트

# 3. cedevops.cosmeticevolution.net의 DNS IP를 Load Balancer IP로 등록

# 4. Firewall / Security Group 
VPCb Internet Gateway Firewall에 192.168.21.0/24 / 0.0.0.0/24 port 80, 443, 6443, 8443  outbound 규칙 추가
K8sSBb Security Group에 0.0.0.0/0 80, 443, 8443 outbound 규칙 추가
