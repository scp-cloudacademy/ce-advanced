
# 1. Create Certificates

### 인증서 발급을 위한 서버 생성
Public Subnet(WEBa)에 NAT IP가 연결된 CentOS Virtual Server를 생성
```
yum install yum-utils -y
cd /etc/yum.repos.d
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/nginx.repo
yum install nginx -y
```
### NAT IP를 DNS에 등록
```
cosmeticevolution.net   # apps.cosmeticevolution.net는 각자 등록한 도메인으로 설정
Record A : apps   NAT IP
```

### Virtual Server에서 다음 명령어 실행 

1) 레포지토리 조회
```
sudo yum repolist | grep epel
```
* 조회가 안되는 경우 설치
  ```
  sudo yum -y install epel-release
  ```
2) Certbot 설치
```
sudo yum install certbot python2-certbot-nginx
```

###### ※ 인증서는 절차가 간소한 standalone 방식으로 발급하며, 발급 전 웹서버 서비스를 잠시 중지시켜야 한다.
```
sudo systemctl stop nginx
```

3) 인증서 발급

```
sudo certbot certonly --standalone -d apps.cosmeticevolution.net # apps.cosmeticevolution.net는 각자 등록한 도메인으로 설정
```
첫째 질문, 메일 주소 질문 : 메일 주소 입력
둘째 질문, ACME 서버 등록 여부 확인 : 반드시 Y
셋째 질문, 메일 주소 공유 질문 : Y 또는 N 선택

발급 완료 후 인증서 확인 및 저장 위치 기록

```
sudo ls -l /etc/letsencrypt/archive/apps.cosmeticevolution.net
```

apps.cosmeticevolution.net의 DNS IP를 Load Balancer IP로 등록

인증서 관리에 인증서 등록
상품 신청 
인증서명 : apps.cosmeticevolution.net
용도 : 운영
Private Key : Privkey1
Certificate: Full Chain

다음 유효성 체크 
다음 확인

K8S Apps에서
툴세팅K8s Ingress 와는 다른 namespace 신규 생성 cedevopstools
Jenkins 
이름 : cedevopsjenkins
비밀번호: 임의
External URL : https://apps.cosmeticevolution.net/jenkins
Ingress 사용
Domain apps.cosmeti
class nginx
certificate 사용
            tls 인증서 관리 선택
	    PVC 사용 기본으로
설치 창을 열어서 디플로이먼트 1/1, 잡도 1/1로 되어야 함

Gitlab 생성
cedevopstools
이름: cedevopsgitlab
Postgresql: Internal
외부DB 5개는 기본으로
External URL : https://apps.cosmeticevolution.net/gitlab
		nginx
Certificate : 인증서 관리
PVC 기본
Nexus 패쓰
Sonarqube 패쓰
설치 창을 열어서 디플로이먼트 1/1, 잡도 1/1로 되어야 함

# 2. 방화벽 규칙 설정
Internet Gateway Firewall
192.168.21.0/24 / 0.0.0.0/0 outbound 80,443,6443,8443

K8sSG

0.0.0.0/0 outbound 80,443,8443

LB NAT IP를 도메인에 등록(80, 443) LB IP는 Public IP를 미리 만들어 확인


SCP Secure Copy 

데브옵스 서비스에서 상품 신청

테넌트 이름은 cedevops
테넌트 코드는 cedevopscode
사용자 등록
상품 신청
데브옵스 콘솔 클릭
		테넌트는 프로젝트당 한개
데브옵스 접속
툴 템플릿
툴 관리
  - 툴 추가 클릭

 CICD Pipeline
  - 툴명 cejenkins
  - 툴 Jenkins
  - 툴 분류 CICD Pipeline 
  - 구분 : 개발, 운영
  - 메일 미사용
  - IDP 미사용
  - 관리자 ID: ceadmin
  - 관리자 토큰: Jenkins에 로그인해서 설정 API Token 에서 생성
  - 사용여부 사용: 완료

SCM Repository
  - 툴명 cegitlab
  - 툴 GitLab
  - 신규생성 가능 여부 사용
  - IDP 사용여부 비사용
  - 사용자 인증 타입 ID/Password

  - 인증 확인을 위해서 리눅스 배스천 서버에 들어가서 Kubectl Client로
kubectl exec -it -n devopstoos deveopsgitplab --bash
/etc/gitlab/cat initial_root_password
패스워드를 확인해서
Gitlab으로 접속 root / 패스워드 입력
로그인 해서 패스워드 변경







4) SSL 패키지 설치
```
sudo yum -y install openssl mod_ssl
```
4-1) SSL 패키지 설치확인
```
sudo cat /etc/httpd/conf.modules.d/00-ssl.conf
ls -l /etc/httpd/modules/
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/eef55920-20b2-4771-be72-fa93046ea6ff)

5) SSL 설정변경
```
sudo vi /etc/httpd/conf.d/ssl.conf
```
```
DocumentRoot "/var/www/html/..."
ServerName "도메인:443"

- SSLCertificateFile /etc/letsencrypt/archive/도메인/cert1.pem
- SSLCertificateKeyFile /etc/letsencrypt/archive/도메인/privkey1.pem
- SSLCertificateChainFile /etc/letsencrypt/archive/도메인/chain1.pem
- SSLCACertificateFile /etc/letsencrypt/archive/도메인/fullchain1.pem
```

6) Apache 설정에서 ssl.conf 추가
```
sudo vi /etc/httpd/conf/httpd.conf
```
IncludeOptional conf.d/*.conf 주석해제(확인할 것) </br>

모든 과정이 끝나면 중지시켰던 HTTP서비스를 재부팅해준다.
```
sudo systemctl restart httpd
```
일련의 모든과정이 완료되면, 인증서 발급이 완료가되고,</br>
해당내용을 근거로 SCP에 인증서를 등록해준다.

### 2. SCP 인증서 등록하기

모든상품 ▶ Security ▶ Certificate Manager 상품신청을 클릭해준다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1c34bb1a-62cf-4e71-9de9-113609bee82c)

인증서명을 넣어주고, 각 항목에 맞는 인증서 정보를 조회한 후, 값을 넣어준다.</br>
항목에 값을 모두 넣어준뒤 인증서 유효체크를 하고, 다음을 눌러 생성을 해준다.</br>

※ Certificat Chain 값을 넣을 때는 Certificate Chain은 Intermediate CA(Subordinate CA) → Root CA 순서로 입력을 하고,</br> 
해당 내용 관련 SCP 인증서 가이드 참고 </br>
[SCP 인증서 등록가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#4741ae3ae409b228)

### 3. SSL 유효성 체크
SCP 인증서까지 등록이 완료가 되면, 서버에서 SSL 유효성 체크를 실시한다.</br>

1st Step
```
sudo openssl crl2pkcs7 -nocrl -certfile /etc/letsencrypt/archive/등록도메인/cert1.pem | openssl pkcs7 -print_certs -noout
```

2nd Step
```
sudo openssl x509 -noout -modulus -in /etc/letsencrypt/archive/등록도메인/cert1.pem | openssl md5
sudo openssl rsa -noout -modulus -in /etc/letsencrypt/archive/등록도메인/privkey1.pem | openssl md5
```
두개의 값이 일치하는지 확인

3rd Step
```
sudo openssl x509 -noout -in /etc/letsencrypt/archive/등록도메인/cert1.pem -dates
```
인증서 유효기간 확인 기간이 지나면 갱신필요

4th Step
```
sudo openssl verify -CAfile /etc/letsencrypt/archive/등록도메인/chain1.pem /etc/letsencrypt/archive/등록도메인/cert1.pem
```
4번째까지 명령어를 입력을 하면 에러가 생성됨
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8584edea-a682-4d47-9003-70980db960ea)


■ 해결방법 ■
1. self-signed Root certificate download
```
sudo wget https://letsencrypt.org/certs/isrgrootx1.pem --no-check-certificate
```
2. Chain1.pem 파일을 복제한다.
```
sudo cp /etc/letsencrypt/archive/등록 도메인/chain1.pem /etc/letsencrypt/archive/등록 도메인/chain1_copy.pem
```
3. Chain1.pem의 Root Certificate 부부을 self-signed root certificate(1에 다운로드 파일내용으로 복사 후 넣어주면 됨)로 변경
4. 4th Step의 명령어를 다시입력</br>
결과값에 '/etc/letsencrypt/archive/등록 도메인/cert1.pem: OK' 라고 나오면 완료
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/617cbca8-2835-407d-83f9-15855aa9caec)

# 2. Create Nat Gateway for Web/App/DB Subnet

# 3. Create Virtual Servers

### Web Server Init Script
```
#!/bin/bash
sudo yum install yum-utils -y
sudo systemctl stop httpd
cd /etc/yum.repos.d
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/nginx.repo
sudo yum install nginx -y
cd /
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/web.tar
sudo tar -xvf web.tar
sudo chmod -R 755 /usr/share/nginx/html/web
echo
```

### WAS Server Init Script
```
#!/bin/bash
sudo yum -y install -y epel-release yum-utils
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --disable remi-php54
sudo yum-config-manager --enable remi-php81
sudo yum install -y php php-cli php-common php-devel php-pear php-fpm
sudo yum install -y php-mysqlnd php-mysql php-mysqli php-zip php-gd php-curl php-xml php-json php-intl php-mbstring php-mcrypt php-posix php-shmop php-soap php-sysvmsg php-sysvsem php-sysvshm php-xmlrpc php-opcache
sudo systemctl stop php-fpm
cd /
sudo curl -o https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
또는
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
sudo tar -xvf was.tar
sudo chmod -R 755 /usr/share/nginx/html
sudo chmod -R 777 /var/lib/php/session
sudo chown -R vmuser:vmuser /usr/share/nginx/html
sudo chown -R vmuser:vmuser /var/lib/php/session
sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
sudo systemctl restart network
echo
```

# 4. Adding Server Group and LB Service for Web / App

# 5. Adding Load Balancer Service IP range to Transit Gatewy Routing

Adding 192.168.14.0/27 in VPCdmz Routing  
Adding 192.168.14.0/27 in VPCa TG Routing

# 6. Configure DNS

    www       WebLB Private IP
    was       WASLB Private IP
    db        DB server Private IP

# 7. In Bation Host, Connnet and configure DB Server

### Step 1 – Prerequsitis
### Install and enable Remi 

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

### Install MySQL 8.0.35

    sudo yum -y install mysql-server
    
### Check Version

    mysqld -V

### Start and Enable MySQL 

    sudo systemctl start mysqld
    sudo systemctl enable mysqld

    
### Check initial password
    
    sudo grep 'temporary password' /var/log/mysqld.log

### Change password

    sudo mysql -u root -p

example) ALTER USER 'root'@'localhost' IDENTIFIED BY 'abcd1234';

```mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'VMuser1@';
```

### Allow access from external

```mysql
use mysql;
select host, user from user;
```

```mysql
CREATE USER 'vmuser'@'%' IDENTIFIED BY 'VMuser1@';
GRANT ALL PRIVILEGES ON *.* TO 'vmuser'@'%';
```

```mysql
FLUSH PRIVILEGES;
```

```mysql
select host, user from user;
```

```bash
sudo systemctl restart mysqld
```
In Bation Host, Install and launch Workbench and upload schema

[cosmetic data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_COSMETIC.sql)

[Movie data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_MOVIES.sql)




# 8. In Bation Host, Connnet and configure App Server

	sudo systemctl stop php-fpm
	sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
	sudo systemctl restart network
	sudo systemctl enable php-fpm
  	sudo systemctl start php-fpm

# 9. In Bation Host, Connnet and configure Web Server

	sudo systemctl enable nginx
	sudo systemctl start nginx


# 10. Create Custom Image and Create addtional Web / App Servers

# 11. Enroll Web/App Server to each LB Server Group

# 12. Public Domain Setup and Service Test / HA Test

