##### Apache http 설치 (web-server) 
sudo apt-get update </br>
sudo apt-get -y install apache2 </br>
sudo service apache2 start </br>
sudo service apache2 enable </br></br>

##### PHP 설치 (was-server)
※ [설치 시 참고사이트](https://t-okk.tistory.com/153) </br>

sudo apt-get update </br>
sudo apt-get -y install apache2 </br>
sudo service apache2 start </br>
sudo service apache2 enable </br>

sudo apt install php libapache2-mod-php php-mysql </br>
apt list php-* php7.4-* </br>
sudo apt install php-{bz2,imagick,imap,intl,gd,mbstring,pspell,curl,readline,xml,xmlrpc,zip} </br>

##### info파일 구성하기
경로: /var/www/html/index.php </br>
아래 내용을 추가하여 저장해 준다. </br>
∴ sudo vi /var/www/html/index.php </br>
```
<?php
phpinfo();
?>
```


