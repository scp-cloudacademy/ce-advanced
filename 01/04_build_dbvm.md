# Building Database VM

  **Scenario :** Cosmetic Evolution Server

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above, VM Workstation Pro, [CentOS 7.9 VM Image](https://github.com/scp-cloudacademy/ce-advanced/blob/main/01/02_build_vm_image.md))

#Step 1 – Prerequsitis
Install and enable Remi 

    sudo yum -y install epel-release      # Remi 저장소를 설치하고 활성화한다.
    sudo yum -y install https://dev.mysql.com/get/mysql80-community-release-el7-11.noarch.rpm

# Install MySQL 8.0.35

    sudo yum install mysql-server
    
# Check Version

    mysqld -V

# Start and Enable MySQL 

    systemctl start mysqld
    systemctl enable mysqld

# Check initial password

    grep 'temporary password' /var/log/mysqld.log

# Change password

    mysql -u root -p

example) ALTER USER 'root'@'localhost' IDENTIFIED BY 'abcd1234';

```mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY '비밀번호';
```

# Allow access from external

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
