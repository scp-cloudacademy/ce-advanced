# Building Web VM

  **Scenario :** Cosmetic Evolution Server

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above, VM Workstation Pro, [CentOS 7.9 VM Image](https://github.com/scp-cloudacademy/ce-advanced/blob/main/01/02_build_vm_image.md))

### 1. Install web server
Start webvm in the VMware Workstation Pro and Log in as root account

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

```
server {
    listen       80;
    server_name localhost;
    root   /usr/share/nginx/html;

    #access_log  /var/log/nginx/host.access.log  main;

    location / {
        index  index.html index.htm index.php;
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
    
    location ~ \.php$ {
        fastcgi_pass   192.168.11.6:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  	$document_root$fastcgi_script_name;
	include        fastcgi_params;
    }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    #location ~ /\.ht {
    #    deny  all;
    #}
}
```

```
firewall-cmd --zone=public --permanent --add-port=22/tcp    # 22번 포트 오픈
firewall-cmd --zone=public --permanent --add-port=80/tcp    # 80번 포트 오픈
firewall-cmd --reload                                       # 리로드
firewall-cmd --zone=public --list-all                       # 리스트 불러오기
```

```
```




### 2. Import Web Source
```
cd /usr/share/nginx/html
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/web.tar
tar -xvf web.tar
sudo systemctl start nginx
```

