##### Apache http 설치 (web-server) 
```
sudo apt-get update 
sudo apt-get -y install apache2
sudo service apache2 start
sudo service apache2 enable
``` 

##### PHP 설치 (was-server)
※ [설치 시 참고사이트](https://t-okk.tistory.com/153) </br>

```
sudo apt-get update </br>
sudo apt-get -y install apache2
sudo service apache2 start 
sudo service apache2 enable


sudo apt install php libapache2-mod-php php-mysql 
apt list php-* php7.4-* 
sudo apt install php-{bz2,imagick,imap,intl,gd,mbstring,pspell,curl,readline,xml,xmlrpc,zip}
```

##### info파일 구성하기
경로: /var/www/html/index.php </br>
아래 내용을 추가하여 저장해 준다. </br>
```
sudo vi /var/www/html/index.php
```
```
<?php
phpinfo();
?>
```

##### Mysql related configurations
```
sudo vi /etc/php/8.1/cli/php.ini
```
mysqli.default_port = 3306 </br>
mysqli.default_host = Mysql IP address </br>
mysqli.default_user = Mysql user name </br>
mysqli.default_pw = Password PHRASE </br>

##### 시스템 재시작
```
sudo service apache2 restart
```













