# Configure PHP Applicattion Server 

## Open Firewall port

```
firewall-cmd --zone=public --permanent --add-port=9000/tcp    # 3306번 포트 오픈
firewall-cmd --zone=public --permanent --add-port=22/tcp      # 22번 포트 오픈
firewall-cmd --reload                                         # 리로드
firewall-cmd --zone=public --list-all                         # 리스트 불러오기
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

## Enabling PHP-FPM 

    sudo systemctl --now enable php-fpm

## Configuring php.ini

    sudo vi  /etc/php.ini
    
Include the lines in the end of php.ihi

    [Database]
    mysql.host=db.cesvc.net
    mysql.username=vmuser
    mysql.passwd=VMuser1@
    mysql.dbname=cosmetic
    mysql.port=3306

## (Option) Hiding PHP version info

    sed -i "s/expose_php = On/expose_php = Off/g" /etc/php.ini

## Configuring PHP-FPM

    vi /etc/php-fpm.d/www.conf

- Change the parameters in the listed lines

; Unix user/group of processes

; Note: The user is mandatory. If the group is not set, the default user's group

;       will be used.

; RPM: apache user chosen to provide access to the same directories as httpd

    user = vmuser
    
; RPM: Keep a group allowed to write in log dir.

    group = vmuser
    
; The address on which to accept FastCGI requests.

; Valid syntaxes are:

;   'ip.add.re.ss:port'    - to listen on a TCP socket to a specific IPv4 address on

;                            a specific port;

;   '[ip:6:addr:ess]:port' - to listen on a TCP socket to a specific IPv6 address on

;                            a specific port;

;   'port'                 - to listen on a TCP socket to all addresses

;                            (IPv6 and IPv4-mapped) on a specific port;

;   '/path/to/unix/socket' - to listen on a unix socket.

; Note: This value is mandatory.

    listen = was.php4autoscaling:9000

; Set listen(2) backlog.

; Default Value: 511

;listen.backlog = 511

; Set permissions for unix socket, if one is used. In Linux, read/write

; permissions must be set in order to allow connections from a web server.

; Default Values: user and group are set as the running user

;                 mode is set to 0660

    listen.owner = vmuser
    listen.group = vmuser
    listen.mode = 0660

## Download PHP Source Files

    cd /usr/share/
    wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/01/was.tar
    tar -xvf was.tar
    sudo chown -R vmware:vmware /usr/share/nginx/html/
    sudo systemctl stop php-fpm
    sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    sudo systemctl restart network
    sudo systemctl start php-fpm
    

## <Important > Custom Image를 사용하여 Virtual Server를 생성할 때 init script에 아래를 반드시 삽입

    #!/bin/bash
    sudo systemctl stop php-fpm
    sudo sh -c 'echo "$(hostname -I | awk "{print \$1}") was.php4autoscaling" >> /etc/hosts'
    sudo systemctl restart network
    sudo systemctl start php-fpm


## Edit Local domain for php-fpm listening

     if [[ -n "$(hostname -I)" ]]; then
        echo "$(hostname -I | awk '{print $1}') was.suntaeidea.php4autoscaling" | sudo tee -a /etc/hosts
     fi
     sudo systemctl restart NetworkManager
