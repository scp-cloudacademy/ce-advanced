
# 1. Configure Web Server
Login as root
Install nginx
```
yum install yum-utils -y
systemctl stop httpd
vi /etc/yum.repos.d/nginx.repo
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
yum install nginx -y
systemctl stop nginx
```
Config NGINX

Type vi command

```
vi /etc/nginx/conf.d/default.conf
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

# 2. Configure PHP Applicattion Server 

Edit Local domain for php-fpm listening

     if [[ -n "$(hostname -I)" ]]; then
        echo "$(hostname -I | awk '{print $1}') was.suntaeidea.php4autoscaling" | sudo tee -a /etc/hosts
     fi
     sudo systemctl restart NetworkManager

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

# 3. Building Database
#Step 1 – Prerequsitis
Install and enable Remi 

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

# Install MySQL 8.0.35

    sudo yum install mysql-server
    
# Check Version

    mysqld -V

# Start and Enable MySQL 

    systemctl start mysqld
    systemctl enable mysqld

# Check initial password

    grep 'temporary password' /var/log/mysqld.log

# Change password

    mysql -u root -p

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

# 4. Configuring php.ini

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
    

## <Important > Custom Image를 사용하여 Virtual Server를 생성할 때 init script에 아래를 반드시 삽입

    #!/bin/bash
    sudo systemctl stop php-fpm
    sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    sudo systemctl restart network
    sudo systemctl start php-fpm

