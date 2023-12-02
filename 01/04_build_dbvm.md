# Building Database VM

  **Scenario :** Cosmetic Evolution Server

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above, VM Workstation Pro, [CentOS 7.9 VM Image](https://github.com/scp-cloudacademy/ce-advanced/blob/main/01/02_build_vm_image.md))

### 1. Install HTTPD




https://link2me.tistory.com/1838

https://cwiki.apache.org/confluence/display/HTTPD/PHPFPMWordpress

https://www.stephenrlang.com/2018/02/centos-7-apache-2-4-with-php-fpm/

## Setup Database Server

    sudo yum update -y


#Step 1 – Prerequsitis

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

# MySQL 8.0.35 설치

    sudo yum install mysql-server
    
# 버전체크

    mysqld -V

# MySQL 시작 및 자동 실행 등록

    systemctl start mysqld
    systemctl enable mysqld

# 초기 비밀번호 확인

    grep 'temporary password' /var/log/mysqld.log

# 비밀번호 변경

    mysql -u root -p

```mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY '비밀번호';
```

# 외부 접속 허용

```mysql
use mysql;
select host,user from user;
```

```mysql
grant all privileges on *.* to 'root'@'%';
```

```mysql
flush privileges
```

```mysql
select host, user form user;
```

```bash
sudo systemctl restart mysqld
```
