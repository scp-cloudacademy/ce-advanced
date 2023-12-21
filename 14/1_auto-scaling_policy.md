# Auto-Scale
## 1. Create Custom Images
## 2. Create Launch Configuration
### init script 
##### WEB
    sudo systemctl enable nginx
    sudo systemctl start nginx
##### App
    #!/bin/bash
    sudo systemctl enable php-fpm
    sudo systemctl start php-fpm
## 3. Create LoadBalancer 
### Configuration
###### WEB
    Service port: 80
    NAT IP: use
##### App
    Service port: 9000
## 4. Create Auto-scaling 
### Configuration
##### Web
    Number of Servers:  Min:2  Desired:4  Max:6
    Load Balancer: use
    select LB Service for Web servers
    Policy: Configure later
##### App
    Number of Servers:  Min:2  Desired:4  Max:6
    Load Balancer: use
    select LB Service for App servers
    Policy: Configure later

# Auto-scaling Policy
## 1. Scale in/out policy
### Configuration 
#### Web
    MAX  CPU usage  >=  60%  1분    # Scale out condition
    Average  CPU usage  <=  30%  1분    #Scale In  condition
#### App
    Average  Memory usage  >=  60%  1분  # Scale out condition
    Average  Memory usage  <=  20%  1분  # Scale In condition
    
## 2. Monitoring 
## 3. Check Service
1) check the status: down 
2) Change Auto-Scaling Service Health check port </br>
  Web 8080 ▶ 80 </br>
  App 8080 ▶ 9000
3) Configure domain record
```
Private Domain
www: 192.168.14.3
WAS: 192.168.14.4

Public Domain
Web asg NAT IP
```
### 4. Stress Test  
    
     
