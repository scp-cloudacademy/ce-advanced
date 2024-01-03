#!/bin/bash

# Install epel-release and yum-utils
sudo yum -y install -y epel-release yum-utils

# Install remi-release repository
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm

# Disable remi-php54 repository and enable remi-php81 repository
sudo yum-config-manager --disable remi-php54
sudo yum-config-manager --enable remi-php81

# Install PHP and necessary extensions
sudo yum install -y php php-cli php-common php-devel php-pear php-fpm
sudo yum install -y php-mysqlnd php-mysql php-mysqli php-zip php-gd php-curl php-xml php-json php-intl php-mbstring php-mcrypt php-posix php-shmop php-soap php-sysvmsg php-sysvsem php-sysvshm php-xmlrpc php-opcache

# Stop php-fpm service
sudo systemctl stop php-fpm

# Change directory to root
cd /

# Download and extract web application server content
sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
# 또는
# sudo curl -o https://github.com/scp-cloudacademy/ce-advanced/raw/main/09/was.tar
sudo tar -xvf was.tar

# Set permissions for web directory
sudo chmod -R 755 /usr/share/nginx/html
sudo chmod -R 777 /var/lib/php/session
sudo chown -R vmuser:vmuser /usr/share/nginx/html
sudo chown -R vmuser:vmuser /var/lib/php/session

# Add entry to /etc/hosts file
sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'

# Restart network service
sudo systemctl restart network

# Display a message
echo "Installation completed successfully."
