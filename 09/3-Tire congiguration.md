# 1. Adding Network Traffic Rules

[Internet Gateway](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/firewall.xlsx)

[Web Security Group](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/web.xlsx)

[App Security Group](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/app.xlsx)

[DB Security Group](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/db.xlsx)


# 2. Create Nat Gateway for Web/App/DB Subnet

# 3. Create Virtual Servers

### Web Server Init Script
```
#!/bin/bash
sudo yum install yum-utils -y
sudo systemctl stop httpd
sudo cd /etc/yum.repos.d
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/nginx.repo
sudo yum install nginx -y
cd /
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/web.tar
sudo tar -xvf web.tar
sudo chmod -R 755 /usr/share/nginx/html/web
echo
```

### WAS Server Init Script
```
#!/bin/bash
sudo yum -y install -y epel-release yum-utils
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --disable remi-php54
sudo yum-config-manager --enable remi-php81
sudo yum install -y php php-cli php-common php-devel php-pear php-fpm
sudo yum install -y php-mysqlnd php-mysql php-mysqli php-zip php-gd php-curl php-xml php-json php-intl php-mbstring php-mcrypt php-posix php-shmop php-soap php-sysvmsg php-sysvsem php-sysvshm php-xmlrpc php-opcache
sudo systemctl stop php-fpm
sudo cd /
sudo curl -o https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
또는
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
sudo tar -xvf was.tar
sudo chmod -R 755 /usr/share/nginx/html
sudo chmod -R 777 /var/lib/php/session
sudo chown -R vmuser:vmuser /usr/share/nginx/html
sudo chown -R vmuser:vmuser /var/lib/php/session
sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
sudo systemctl restart network
echo
```

# 4. Adding Server Group and LB Service for Web / App

# 5. Adding Load Balancer Service IP range to Transit Gatewy Routing

Adding 192.168.14.0/27 in VPCdmz Routing  
Adding 192.168.14.0/27 in VPCa TG Routing

# 6. Configure DNS

    www       WebLB Private IP
    was       WASLB Private IP
    db        DB server Private IP

# 7. In Bation Host, Connnet and configure DB Server

### Step 1 – Prerequsitis
### Install and enable Remi 

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

### Install MySQL 8.0.35

    sudo yum -y install mysql-server
    
### Check Version

    mysqld -V

### Start and Enable MySQL 

    sudo systemctl start mysqld
    sudo systemctl enable mysqld

    
### Check initial password
    
    sudo grep 'temporary password' /var/log/mysqld.log

### Change password

    sudo mysql -u root -p

example) ALTER USER 'root'@'localhost' IDENTIFIED BY 'abcd1234';

```mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'VMuser1@';
```

### Allow access from external

```mysql
use mysql;
select host, user from user;
```

```mysql
CREATE USER 'vmuser'@'%' IDENTIFIED BY 'VMuser1@';
GRANT ALL PRIVILEGES ON *.* TO 'vmuser'@'%';
```

```mysql
FLUSH PRIVILEGES;
```

```mysql
select host, user from user;
```

```bash
sudo systemctl restart mysqld
```
In Bation Host, Install and launch Workbench and upload schema

[cosmetic data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_COSMETIC.sql)

[Movie data](https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/cosmetic_MOVIES.sql)




# 8. In Bation Host, Connnet and configure App Server

	sudo systemctl stop php-fpm
	sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
	sudo systemctl restart network
	sudo systemctl enable php-fpm
  	sudo systemctl start php-fpm

# 9. In Bation Host, Connnet and configure Web Server

	sudo systemctl enable nginx
	sudo systemctl start nginx


# 10. Create Custom Image and Create addtional Web / App Servers

# 11. Enroll Web/App Server to each LB Server Group

# 12. Public Domain Setup and Service Test / HA Test

