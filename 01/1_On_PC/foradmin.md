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
