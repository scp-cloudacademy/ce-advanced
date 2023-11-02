-# SSH 접속하기
[Putty 다운로드](https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html) </br></br>
본인이 사용하는 pc 사양에 맞는 버전을 다운로드 받고, 설치를 한다.</br>
설치가 완료된 후, [접속방법](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#61ddd538a41cdb3d)을 참고하여 접속해준다

# Apache HTTP Server 패키지 설치 및 환경구성
##### http 설치
```
sudo yum -y install httpd
sudo systemctl start httpd.service
sudo systemctl enable httpd.service
```

##### php설치
```
sudo yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
sudo yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum install -y yum-utils
sudo yum-config-manager --disable 'remi-php*'
sudo yum-config-manager --enable remi-php80
sudo yum -y install php php-{cli,fpm,mysqlnd,zip,devel,gd,mbstring,curl,xml,pear,bcmath,json}
sudo yum -y install php-redis
```

※ Centos7.8의 경우, PHP version 5.4가 기본으로 설치되지만, Wordpress 최신버전과 호환성을 위해 PHP 8 이상의 버전으로 설치한다</br> 

### PHP 구성
1. info파일 구성 </br>
경로: /var/www/html/info.php </br>
아래 내용을 추가하여 저장해준다.
```
<?php
phpinfo();
?>
```
2. Mysql 구성
경로: /etc/php.ini </br>
생성한 mysql DB 정보를 넣어준다 </br></br>
   extension=mysqli </br>
   mysqli.default_port = 2866 </br>
   mysqli.default_host = Mysql IP address </br>
   mysqli.default_user = Mysql user name (생성 시 지정한 user name) </br>
   mysqli.default_pw = Password PHRASE (생성 시 지정한 Pw)

3. 시스템 재시작
```
sudo systemctl restart httpd.service
```

시스템 재부팅 완료 후, 브라우저에서 url/info.php를 접속해본다. </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/160cbbd8-62df-41ae-bb64-b38b4eadf135)
</br>이와같이 화면에 나오면 성공!

# Redis(DBaaS)를 이용한 PHP세션 이중화 구성
1. PHP 세션 저장을 위하 Redis 연동설정</br>
경로: /etc/php.ini</br>
   session.save_handler = redis </br>
   sesstion.save_phth = "tcp://redis ip:6378?auth='PASSPHRASE'"
2. Session 이중화 구성 </br>
PHP 구성된 서버를 절체하면서, Session ID가 유지되지는지 확인! </br>
해당경로에 아래 출력코드를 입력 후 저장해준다 </br>
경로: /var/www/html/session.php
```
<?php

session_start();
echo 'PHP session ID: ';
echo session_id();
echo '<br />';

$count = isset($_SESSION['count']) ? $_SESSION['count'] : 1;
echo 'Count: ';
echo $count;
echo '<br />';
$_SESSION['count'] = ++$count;

?>
```

저장이 완료된 후, url/session.php 입력해주면 아래 그림과 같이 결과가 나오면 성공 </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8de8b04d-982b-40bf-95a5-cc3188c43758)

# File Storage Mount
1. Wordpress 파일 설치할 디렉토리 생성</br>
```
sudo mkdir /var/www/html/wordpress
```

디렉토리 생성 후, 생성한 디렉토리에 파일 스토리지 NFS Volum을 마운트하고, </br>
부팅 시, 항시 마운트 되도록 /etc/fstab에 추가로 설정해 준다.

- 마운트 하기 
```
sudo mount -t nfs -O vers=3 마운트정보/var/www/html/wordpress
```
 ※ 마운트정보는 파일 스토리지 상세현황에서 확인할 수 있음

 - 마운트 확인
```
df -k
```
- 마운트 설정하기
vi편집기로 /etc/fstab경로  접속 후 아래내용 추가</br>
```
마운트정보/var/www/html/wordpress   nfs   default   0 0
```

# wordpress 설치하기
wordpress 최신 패키지 다운 후 압축해제를 하고</br>
시스템 재시작을 한다.

- wordpress 다운로드
```
sudo wget http://wordpress.org/latest.tar.gz
sudo tar –zxvf latest.tar.gz –C /var/www/html
sudo chown –R apache /var/www/html/wordpress
```

- 루트경로 설정</br>
http.comf 파일 루트경로 설정 (/etc/httpd/conf/httpd.conf)</br>
  + DocumentRoot /var/www/html/wordpress</br>
- 시스템 재시작
```
sudo systemctl restart httpd.service
```
# Wordpress Admin 설정
url/wp-admin/setup-config.php</br>
워드프레스 설치를 하고, 로그인을 하면 해준다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b4c067f2-f8ab-4190-a45d-dd8aefee0b66)

여기서 플러그인 캐시를 설치하고 구성한다.
* ###### 1. W3 Total Cache
     W3 total cache 플러그인 설치 후 활성화를 해준다. </br>
     활성화를 한 후 일반설정에 들어가서 CDN을 활성화 체크를 해주고, 유형에는 Akamai를 선택한다 </br>
     저장을 하고 그 다음에 CDN 세부사항을 구성한다.</br>
     여기서 구성부분과, 고급에 다음역할에 CDN 비활성화에 Administrator를 선택 후 최종 저장을 해주면 끝~</br>
     ![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0e04d973-0364-42d5-91fe-4a46c768bd42)
     ![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/060cbdef-39b8-424a-b53a-aeca74b5ce61) </br>
* ###### 2. Redis Object
   Cache플러그인에서 Redis Object Cache 설치 후 활성화를 해준다.</br>
   활성화를 해 준 다음에 VI편집기에서 Wordpress 환경설정을 해준다. </br></br>
     경로: /var/www/html/wordpress/wp-config.php </br>
         define('WP_REDIS_HOST','Redis IP'); </br>
         define('WP_REDIS_DATABASE','0'); </br>
         define('WP_CACHE_KEY_SALT','wf_'); </br>
         define('WP_REDIS_MAXTTL','86400'); </br>
         define('WP_REDIS_PORT','6378'); </br>
         define('WP_REDIS_PASSWORD','지정 패스워드'); </br>
  </br> 연동이 끝나고 브라우저에서 확인을 해보면 연결됨을 확인할 수 있다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/795ca323-ff20-42c0-8f27-7985df08ecaf)

# HTTP 환경구성
1. SSL Certificate 발급</br>
[인증서발급 참조](https://blog.jiniworld.me/137#a02-1)

+ epel-release 설치여부 확인
```
yum repolist | grep epel
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a2a2c6a8-505d-46dd-b459-def90cda93bb)</br>
그림과 같이 나온다면 설치가 되었다. </br>
만약 설치가 필요하면 다음 명령어를 통해 설치를 해준다.
+ 설치하기
```
sudo yum -y install epel-release
```
+ Certbot 설치하기
Certbot과 Certbot Apache 웹서버 플러그인을 설치한다.
```
sudo yum -y install certbot python2-certbot-apache
```
※인증서 발급 전 주의사항
   --standalone 방식으로 인증서를 발급할 예정이며, 발급 시 웹서버를 stop으로 변경을 꼭 해야된다.
   + 웹서버 Stop
```
sudo systemctl stop httpd
```
- ###### 인증서 발급하기      
```
sudo certbot certonly --standalone -d "등록할 도메인"
```
설치 시, 사용할 이메일등록, ACME 서버등록 동의, 이메일 수신여부를 등록하면 인증서가 발급이 완료된다.</br>
발급이 완료가 되면 시스템을 다시 재시작을 해준다.

- 시스템 재시작
```
sudo systemctl restart httpd.service
```

- ##### SSL 패키지 설치
```
sudo yum -y install openssl mod ssl
```
- 설치된 패키지 확인
```
sudo cat /etc/httpd/conf.modules.d/oo-ssl.conf
```
```
ls -l /etc/httpd/modules/
```
- ##### Apache HTTP Server 설정변경
  SSL 설정변경 </br>
  + 경로: /etc/httpd/conf.d/ssl.conf
    - DocumentRoot "/var/www/html/wordpress"   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; \# General setup for the virtual host, inherited from global configuration
    - ServerName 도메인:443</br></br>

    - SSLCertificateFile /etc/letsencrypt/archive/도메인/cert1.pem        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       \#  Server Certificate
    - SSLCertificateKeyFile /etc/letsencrypt/archive/도메인/privkey1.pem   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              \#  Server Private Key
    - SSLCertificateChainFile /etc/letsencrypt/archive/도메인/chain1.pem     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            \#  Server Certificate Chain
    - SSLCACertificateFile /etc/letsencrypt/archive/도메인/fullchain1.pem      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          \#  Certificate Authority (CA)

