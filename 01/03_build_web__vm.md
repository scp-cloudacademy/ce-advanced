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

```

### 2. Install Web Source
```
cd /var/www/html
wget 
