
    cat /etc/redhat-release

CentOS Linux release 7.9.2009 (Core)

     getconf LONG_BIT
64

EPEL 및 YUM Utilities 패키지 설치

    yum -y install -y epel-release yum-utils

Remi 저장소 설치

    yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm

remi 저장소 활성화

PHP 5.4 비활성화(default version) 및 PHP 8.1 활성화
default version 정보

    yum info php-fpm | grep Version

Version     : 5.4.45
php 5.4 비활성화(default version)

    yum-config-manager --disable remi-php54

PHP 8.1 활성화
Remi 저장소를 활성화하고, PHP 8.1을 설치합니다.
    
    yum-config-manager --enable remi-php81

PHP(php-fpm) 8.1 설치

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

참고  https://scbyun.com/entry/PHP-PHP-FPM-%EC%B5%9C%EC%8B%A0php-fpm-81-%EB%B2%84%EC%A0%84-%EC%84%A4%EC%B9%98%ED%95%98%EA%B8%B0

