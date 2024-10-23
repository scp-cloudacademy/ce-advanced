# 0. Download Certificates from Let

https://letsencrypt.org/certificates/


# 1. Create Certificates

### Create temporary Virtual Server for certificates creation.
CentOS Virtual Server in Public Subnet(WEBa) with NAT IP
```
sudo yum install httpd -y
```
### Register NAT IP to DNS
```
cosmeticevolution.net   # apps.cosmeticevolution.net can change to your own DNS
Record A : apps   NAT IP
```

### Run commands at Virtual Server

#### 1) Repo list
```
sudo yum repolist | grep epel
```
* If you cannot see, install
  ```
  sudo yum -y install epel-release
  ```
#### 2) Install Certbot
```
sudo yum install certbot python2-certbot-apache -y
```

###### ※ Before issuing certificates, stop nginx.
```
sudo systemctl stop nginx
```

#### 3) Issue Certificates
Check Allow 80 port at IGW Fireall and Security Group
```
sudo certbot certonly --standalone -d apps.cosmeticevolution.net # apps.cosmeticevolution.net can be changed to your own DNS
```

Move to path of certificates files( as root)

```
sudo cd /etc/letsencrypt/archive/devops.cosmeticevolution.net
```

#### 4) Register certificates to Certificate Manager

Certificates name : cedevops_cosmeticevolution_net
Usage : Operaion
Register Certificates
Private Key : privkey1.pem           # Certificates from Server

Certificate body: cert1.pem     # Certificates from Server

Certificate chain: first boy of chain1.pem and root.pem  #Root and Intermediate pem certificates Letsencrypt

# 2. Load Balancer LB Group/Service 443, ingress 443

# 3. Register Load Balancer IP for cedevops.cosmeticevolution.net DNS record

# 4. Firewall / Security Group 
Add 192.168.21.0/24 , 0.0.0.0/24 port 80, 443, 6443, 8443  outbound rules in VPCb Internet Gateway Firewall
Add 0.0.0.0/0 80, 443, 8443 outbound rules in K8sSBb Security Group
