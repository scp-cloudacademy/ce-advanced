# SSH 접속하기
[Putty 다운로드](https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html/) </br></br>
본인이 사용하는 pc 사양에 맞는 버전을 다운로드 받고, 설치를 한다.</br>
설치가 완료된 후, [접속방법](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#61ddd538a41cdb3d/)을 참고하여 접속해준다

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

- 마운트 설정하기
vi편집기로 /etc/fstab경로  접속</br>
```
마운트정보/var/www/html/wordpress   nfs   default   0 0
```

