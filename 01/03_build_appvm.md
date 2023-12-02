# Configure PHP Applicattion Server 

## Install EPEL and YUM Utilities Package

    yum -y install -y epel-release yum-utils

## Install Remi Repo

    yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm

## Enable PHP 8 Remi Repo
    yum-config-manager --disable remi-php54
    yum-config-manager --enable remi-php81

## Install PHP(php-fpm) 8.1 설치

    yum install -y php php-cli php-common php-devel php-pear php-fpm
PHP 확장 모듈 추가 설치

    yum install -y php-mysqlnd php-mysql php-mysqli php-zip php-gd php-curl php-xml php-json php-intl php-mbstring php-mcrypt php-posix php-shmop php-soap php-sysvmsg php-sysvsem php-sysvshm php-xmlrpc php-opcache

PHP(php-fpm) 버전 정보 확인

    php-fpm -version

PHP-FPM 서비스 시작 및 활성화
PHP-FPM 서비스를 시작하고, 부팅 시 자동으로 실행되도록 설정합니다.

    systemctl --now enable php-fpm

PHP 설정 파일 위치 확인
php.ini 파일 경로 찾기

    php --ini | egrep "Loaded Configuration File"

Loaded Configuration File:         /etc/php.ini

    vi  /etc/php.ini

PHP 버전 정보 숨기기

    sed -i "s/expose_php = On/expose_php = Off/g" /etc/php.ini


    vi /etc/php-fpm.d/www.conf

설정 변경

if [[ -n "$(hostname -I)" ]]; then
    echo "$(hostname -I | awk '{print $1}') was.suntaeidea.php4autoscaling" | sudo tee -a /etc/hosts
fi
sudo systemctl restart NetworkManager

```

```

    mkdir /usr/share/nginx
    mkdir /usr/share/nginx/html
    cd /usr/share/nginx/html
    wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/was.tar
    tar -xvf was.tar
    sudo chown -R vmware:vmware /usr/share/nginx/html/

