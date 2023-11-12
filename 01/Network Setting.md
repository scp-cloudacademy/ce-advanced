
Network Architecture
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/acc127cf-7062-4e11-81fa-5de138961341)


Network Configuration

|Location|VPC name|Subnet name|Subnet Usage|CIDR|
|:------------:|:----:|:---------|:----------|:-----------------:|
|KOREA-WEST|VPCdmz|BASTIONa|General/Public|192.168.0.0/24|
|KOREA-WEST|VPCdmz|LoadBalancer|LBServiceIP|192.168.1.0/27|
|KOREA-WEST|VPCdmz|LOCALa|Local|192.168.2.0/24|
|KOREA-WEST|VPCa|WEBa|General/Private|192.168.11.0/24|
|KOREA-WEST|VPCa|APPa|General/Public|192.168.12.0/24|
|KOREA-WEST|VPCa|DBa|General/Public|192.168.13.0/24|
|KOREA-WEST|VPCb|K8Sb|General/Private|192.168.21.0/24|
|KOREA-EAST-1|VPCc|BASTIONdr|General/Public|192.168.30.0/24|
|KOREA-EAST-1|VPCdr|WEBdr|General/Private|192.168.31.0/24|
|KOREA-EAST-1|VPCdr|APPdr|General/Private|192.168.32.0/24|
|KOREA-EAST-1|VPCdr|DBdr|General/Private|192.168.33.0/24|
