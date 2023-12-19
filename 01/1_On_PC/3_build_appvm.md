# Configure PHP Applicattion Server 

## Open Firewall port

```
firewall-cmd --zone=public --permanent --add-port=9000/tcp    # 9000 for PHP-FPM
firewall-cmd --zone=public --permanent --add-port=3306/tcp    # 3306 for MySQL
firewall-cmd --zone=public --permanent --add-port=22/tcp      # 22 for SSH
firewall-cmd --reload                                         
firewall-cmd --zone=public --list-all                         
```
## Download Putty and connect App server

https://www.putty.org/

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

## Download APP Source code 

    wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/1_On_PC/was.tar
    cd /
    tar -xvf /home/vmuser/was.tar

## Change Directory Permission

    chmod -R 755 /usr/share/nginx/html
    chmod -R 777 /var/lib/php/session
    chown -R vmuser:vmuser /usr/share/nginx/html
    chown -R vmuser:vmuser /var/lib/php/session

## Change Hosts File 
    sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    systemctl restart network


## (After Configuring Web Server) Enabling PHP-FPM 

    sudo systemctl --now enable php-fpm
