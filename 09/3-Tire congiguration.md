
#### 1. Web Server 구성
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
