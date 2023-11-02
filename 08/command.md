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

##### PHP 세부설정
vi 편집기에서 아래 내용을 추가하고 저장해준다.</br>
</br> 저장경로: /var/www/html/info.php 
```
<?php
phpinfo();
?>
```
