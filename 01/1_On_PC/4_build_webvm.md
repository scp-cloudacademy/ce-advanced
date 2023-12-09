# Building Web VM

  **Scenario :** Cosmetic Evolution Server

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above, VM Workstation Pro, [CentOS 7.9 VM Image](https://github.com/scp-cloudacademy/ce-advanced/blob/main/01/02_build_vm_image.md))

### 1. Configure Firewall

Start webvm in the VMware Workstation Pro and Log in as root account
```
firewall-cmd --zone=public --permanent --add-port=22/tcp    # 22번 포트 오픈
firewall-cmd --zone=public --permanent --add-port=80/tcp    # 80번 포트 오픈
firewall-cmd --zone=public --permanent --add-port=9000/tcp    # 80번 포트 오픈
firewall-cmd --reload                                       # 리로드
firewall-cmd --zone=public --list-all                       # 리스트 불러오기
```

### 2. Setting Hosts file
In your Lb PC, Run Notepad as administrator and open hosts file

File location : C:\Windows\System32\drivers\etc\hosts
Type in below domains

	[webvm IP address]   www.cesvc.net 
	[appvm IP address]   was.cesvc.net
	[dbvm IP address]    db.cesvc.net

### 3. Install web server
In SSH Terminal, 

```
yum install yum-utils -y
systemctl stop httpd
cd /etc/yum.repos.d
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/nginx.repo
yum install nginx -y
cd /home/vmuser
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/1_On_PC/web.tar
cd /
tar -xvf /home/vmuser/web.tar
chmod -R 755 /usr/share/nginx/html/web
systemctl start nginx
```

### 3. Return to app server

Run the commnad

	systemctl start php-fpm
 
