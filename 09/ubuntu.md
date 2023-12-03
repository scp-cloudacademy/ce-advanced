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




# 2. Configure Web Server
모든상품 ▶ virtual Server ▶ 상품신청을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6e7f8d97-c695-4e10-869f-bb32a04612fa)
이미지는 표준의 Centos 7.8로 선택 후 다음버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/15bdec22-476f-4a42-b6fe-e9b9abb60e7d)
기본정보를 입력합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c60e0f98-0019-4e15-b405-8c41317ef245)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e328642c-2c47-4626-b44d-991109ea5427)
생성정보를 확인 후 완료를 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/233cd8f9-35b2-4988-8dfc-a7ff9a1547e9)
동일한 방법으로 앱서버 및 DB VM을 생성해 줍니다.

생성이 완료가 되면, Bastion Serve로 접속하여 각 서버를 구성합니다.</br>












