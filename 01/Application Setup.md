
https://link2me.tistory.com/1838
https://cwiki.apache.org/confluence/display/HTTPD/PHPFPMWordpress

## Setup Database Server

    sudo yum update -y


#Step 1 – Prerequsitis

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm

# yum 패키지를 관리

    sudo yum -y install yum-utils

#Step 2 – Install Apache2

    yum -y install httpd

#Step 3 – Install PHP and FastCGI


    sudo yum-config-manager --disable remi-php54 # Disable repo for PHP 5.4 # Disable repo for PHP 5.4
    sudo yum-config-manager --enable remi-php81  # Enable repo for PHP 8.1
    sudo yum -y install --enablerepo=remi-php81 php php-cli mod_ssl php-fpm php-common php-imap php-ldap 
    sudo yum -y install --enablerepo=remi-php81 php-curl php-hash php-iconv php-json php-openssl php-zip 
    sudo yum -y install --enablerepo=remi-php81 php-pdo php-process php-mysqlnd php-devel php-mbstring php-mcrypt php-soap php-bcmath 
    sudo yum -y install --enablerepo=remi-php81 php-pgsql php-libxml php-pear php-gd php-ssh2 php-xmlreader 
    sudo yum -y install --enablerepo=remi-php81 php-xml php-xmlrpc php-pecl-apc php-sockets 
    sudo yum -y install --enablerepo=remi-php81 php-tokenizer php-zlib php-gmp php-Icinga php-intl
