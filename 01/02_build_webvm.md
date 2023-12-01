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

### 2. Import Web Source
```
cd /usr/share/nginx/html
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/web.tar
tar -xvf web.tar
sudo systemctl start nginx
```

