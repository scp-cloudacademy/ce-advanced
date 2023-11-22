# Building Web VM

  **Scenario :** Cosmetic Evolution Server

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above, VM Workstation Pro, [CentOS 7.9 VM Image](https://github.com/scp-cloudacademy/ce-advanced/blob/main/01/02_build_vm_image.md))

### 1. Install HTTPD

Log in as root account

Install httpd
```
yum install httpd -y
systemctl start httpd
ls
```

### 2. Import Web Source
```
cd /var/www/html
wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/web.tar
tar -xvf web.tar
ls
```
