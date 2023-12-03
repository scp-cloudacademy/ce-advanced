# 1. 사전준비
## 방화벽 규칙설정 : 아래의 파일을 참조
[Internet Gateway](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/fw_cea_09.%203-tier%20configuration.xlsx)

[WebaSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/WebSG_cea_09.%203-tier%20configuration.xlsx)

[APPaSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/AppSG_cea_09.%203-tier%20configuration.xlsx)

[DBaSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/DBSG_cea_09.%203-tier%20configuration.xlsx)

# 2. Configure Web Server

Install nginx
```
sudo yum install yum-utils -y
sudo systemctl stop httpd
sudo vi /etc/yum.repos.d/nginx.repo
```
Type [i] , then copy following contents and paste to vi. 
```
[nginx-stable]
name=nginx stable repo
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/
gpgcheck=1
enabled=1
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true

[nginx-mainline]
name=nginx mainline repo
baseurl=http://nginx.org/packages/mainline/centos/$releasever/$basearch/
gpgcheck=1
enabled=0
gpgkey=https://nginx.org/keys/nginx_signing.key
module_hotfixes=true
```
Type [ESC] key and type :wq! to exit

Install NGINX

```
sudo yum install nginx -y
sudo systemctl stop nginx
```
Config NGINX

Type vi command

```
sudo vi /etc/nginx/conf.d/default.conf
```
Refer below script and change the configuration 

```
server {
    listen       80;
    server_name localhost;
    root   /usr/share/nginx/html;

    #access_log  /var/log/nginx/host.access.log  main;

    location / {
        index index.php index.html index.htm;                                           # index.php 추가   
    }

    error_page  404              /404.html;

    # redirect server error pages to the static page /50x.html
    #
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   /usr/share/nginx/html;
    }

    # proxy the PHP scripts to Apache listening on 127.0.0.1:80
    #
    #location ~ \.php$ {
    #    proxy_pass   http://127.0.0.1;
    #}

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    
    location ~ \.php$ {                                                                # 이 라인부터 아래 표시 라인까지 주석 삭제
        fastcgi_pass   was.cesvc.net:9000;                                             # app server 주소:9000
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  	$document_root$fastcgi_script_name;    # 표기 대로 수정
	include        fastcgi_params;    
    }                                                                                  # 이 라인까지 주석 삭제

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    #location ~ /\.ht {
    #    deny  all;
    #}
}

```
##NGINX 활성화 및 시작
```
sudo systemctl enable nginx
sudo systemctl start nginx
```
##(Important) Web Server 이미지를 복제하여 서버를 생성할 때 다음을 init script에 삽입합니다. 

    #!/bin/bash
    sudo systemctl start nginx
    echo
    
# 3. Configure PHP Applicattion Server 

## Install EPEL and YUM Utilities Package

    sudo yum -y install -y epel-release yum-utils

## Install Remi Repo

    sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm

## Enable PHP 8 Remi Repo
    sudo yum-config-manager --disable remi-php54
    sudo yum-config-manager --enable remi-php81

## Install PHP(php-fpm) 8.1

    sudo yum install -y php php-cli php-common php-devel php-pear php-fpm
    sudo yum install -y php-mysqlnd php-mysql php-mysqli php-zip php-gd php-curl php-xml php-json php-intl php-mbstring php-mcrypt php-posix php-shmop php-soap php-sysvmsg php-sysvsem php-sysvshm php-xmlrpc php-opcache
    sudo php-fpm -version

## Enabling PHP-FPM 

    sudo systemctl --now enable php-fpm

# 4. Configuring php.ini

```
sudo systemctl status php-fpm
sudo systemctl stop php-fpm
```
    
    sudo vi  /etc/php.ini
    
Include the lines in the end of php.ihi

    [Database]
    mysql.host=db.cesvc.net
    mysql.username=vmuser
    mysql.passwd=VMuser1@
    mysql.dbname=cosmetic
    mysql.port=3306

## (Option) Hiding PHP version info

    sed -i "s/expose_php = On/expose_php = Off/g" /etc/php.ini

## Configuring PHP-FPM

    vi /etc/php-fpm.d/www.conf

- Change the parameters in the listed lines

; Unix user/group of processes

; Note: The user is mandatory. If the group is not set, the default user's group

;       will be used.

; RPM: apache user chosen to provide access to the same directories as httpd

    user = vmuser
    
; RPM: Keep a group allowed to write in log dir.

    group = vmuser
    
; The address on which to accept FastCGI requests.

; Valid syntaxes are:

;   'ip.add.re.ss:port'    - to listen on a TCP socket to a specific IPv4 address on

;                            a specific port;

;   '[ip:6:addr:ess]:port' - to listen on a TCP socket to a specific IPv6 address on

;                            a specific port;

;   'port'                 - to listen on a TCP socket to all addresses

;                            (IPv6 and IPv4-mapped) on a specific port;

;   '/path/to/unix/socket' - to listen on a unix socket.

; Note: This value is mandatory.

    listen = was.php4autoscaling:9000

; Set listen(2) backlog.

; Default Value: 511

;listen.backlog = 511

; Set permissions for unix socket, if one is used. In Linux, read/write

; permissions must be set in order to allow connections from a web server.

; Default Values: user and group are set as the running user

;                 mode is set to 0660

    listen.owner = vmuser
    listen.group = vmuser
    listen.mode = 0660

## Download PHP Source Files

    cd /usr/share/
    wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/was.tar
    tar -xvf was.tar
    sudo chown -R vmware:vmware /usr/share/nginx/html/
    sudo systemctl stop php-fpm
    sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    sudo systemctl restart network
    sudo systemctl start php-fpm
    

## <Important > 지금 서버를 생성할 때는 사용하지 않고, Custom Image를 사용하여 Virtual Server를 생성할 때 init script에 아래를 반드시 삽입합니다.

    #!/bin/bash
    sudo systemctl stop php-fpm
    sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    sudo systemctl restart network
    sudo systemctl start php-fpm

# 5. Building Database
#Step 1 – Prerequsitis
Install and enable Remi 

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

# Install MySQL 8.0.35

    sudo yum install mysql-server
    
# Check Version

    mysqld -V

# Start and Enable MySQL 

    sudo systemctl start mysqld
    sudo systemctl enable mysqld

# Check initial password

    sudo grep 'temporary password' /var/log/mysqld.log

# Change password

    sudo mysql -u root -p

example) ALTER USER 'root'@'localhost' IDENTIFIED BY 'abcd1234';

```mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY '비밀번호';
```

# Allow access from external

```mysql
use mysql;
select host,user from user;
```

```mysql
grant all privileges on *.* to 'root'@'%';
```

```mysql
flush privileges
```

```mysql
select host, user form user;
```

```bash
sudo systemctl restart mysqld
```

## Databae Schema Setup
아래의 SQL 스키마를 다운 받아 Bastion Host에서 Schema 생성 작업

[cosmetic data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_COSMETIC.sql)

[Movie data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_MOVIES.sql)


# 6. Create Custom Image
생성한 웹,앱 virtual Server의 Custom Image를 생성합니다.
## Custom Image를 이용한 VM 만들기
모든상품 ▶ virtual Server ▶ 상품신청을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6e7f8d97-c695-4e10-869f-bb32a04612fa)
이미지 선택 시, Custom을 클릭하고 생성한 custom Image를 선택후 다음버튼을 누릅니다.</br>

# 7.  LoadBalancer 

## 7.1 LoadBalancer 생성하기
서버의 부하분산을 위해 로드밸런서를 생성합니다.</br>
모든상품 ▶ Networking ▶ Loadbalancer ▶ 상품신청을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7b794a96-cc21-4966-bda1-53a685b7e839)
로드밸런서 명을 정하고, 크기 IP대역을 설정 후. 가용여부를 체크합니다.</br>
Firewall 사용은 모두 해제를 합니다. 모든 설정이 끝나면 다음 버튼을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d8df3008-3c41-4c8e-8e22-2eb9eaa32586)
신청정보 확인 후 완료버튼을 눌러줍니다. 
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/35a8607a-b007-4dcd-8a95-089b1c7a5b51)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/02d64f09-fbe5-49db-a7b4-2c99e3dd3c79)

## 7.2 서버그룹 생성하기

생성된 로드밸런서의 상세정보에서 연결된 자원버튼을 클릭합니다.
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f3b7459e-e47b-4465-9686-7048d56dfb88)
연결된 자원에서 서버그룹 생성을 클릭합니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5c8e1c2c-d813-4fe0-8c22-0ac7fcf25bd7)
서버그룹명을 입력하고 대상서버는 그룹하고자 하는 서버를 추가해줍니다 (ex)appa1, appa2 </br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b8c42563-6133-4f77-932b-06520535562a)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/48291eed-fa84-4f4a-be93-c13254ba8974)
모든 설정 확인 후 완료를 누르면 서버그룹이 생성됨을 확인할 수 있습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c292227d-713b-46b5-8036-a10c1eaeefdf)

## 7.3 LB서비스 생성하기
서비스명을 정하고 서비스 포트는 그룹 생성 시, 사용한 포트를 넣습니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c87920a5-5528-4c5e-a8d5-867c62e7e796)
서버그룹은 미리 생성한 그룹으로 설정을 하과 다음버튼을 누릅니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/742bd48e-7456-4370-af98-67830064f6ef)
신청정보를 확인 후 완료를 눌러 서비스를 생성해 줍니다.</br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8e9f25d6-0edf-475e-acf6-390d4a8ba357)
서비스 상태가 완료가 되면 Active상태로 되었다가 시간이 조금 지나면, up 상태로 활성화 됩니다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/8836b9ca-feb2-4cd5-8c13-96334a15428c)
서비스 상세정보를 보면 설정한 포트와 함께, 서버그룹에 포함된 2개의 서비스 상태가 up임을 확인할 수 있습니다.

## 7.4 DNS 및 App Setting

web: www.cesvc.net
app: was.cesvc.net
db: db.cesvc.net

## 7.5 Service test
가동중인 서버 중 1개를 중지시켰을 때도, 서비스가 작동하는지 확인합니다.

1. firewall 규칙설정
192.168.12.0/24 0.0.0.0/0 80,443 out
192.168.13.0/24 0.0.0.0/0 80,443 out

2. Security Group
WebSG
22 out 192.168.11.0/24 web
22 in   192.168.11.0/24 web
22 out 192.168.12.0/24 app
22 out 192.168.13.0/24 db
80 in 192.168.254.2 lb

AppSG
22 in   192.168.11.0/24 web
80,443 out 0.0.0.0/0 
9000 in 192.168.254.2 lb
3306 out 192.168.13.0/24

DBSg
22 in   192.168.11.0/24 web
80,443 out 0.0.0.0/0 
3306 in 192.168.12.0/24
3306 in 192.168.0.0/24

3. nat gateway 
app, db

3-1 TG 
VPCdmz VPCa 192.168.12.0/24
                     192.168.13.0/24
             
VPCa      TG 192.168.12.0/24
                  192.168.13.0/24 
 
4. 서버 생성
webser  weba1
appserver appa1
db server dba1

5. Custom image 생성

6. VM 생성
web weba2
app appa2

7. LB 서버 그룹
cewebsvrgrp 80, round robin weba1, weba2
ceappsvergrp 서버 9000, round robin, appa1, appa2

8. LB 서비스
cewebsvc 80
ceappsvc 9000

9. dns 
cesvc.net 쇼윙
web: www.cesvc.net
app: was.cesvc.net
db: db.cesvc.net

app setting
도메인 정리해서 넣어줄 것

테스트 죽이는 거
