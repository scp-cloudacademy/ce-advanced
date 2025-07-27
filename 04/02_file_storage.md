
<h1>File Storage Migration</h1>
</br>

## Prerequisition
- Create AWS EFS and store contents</br>
- Establish VPN connection between Samsung Cloud Platform and AWS.

* These prerequisition will not be covered at the lecture.

* To run this part, you need to complete section 1. Create AWS EFS and 2. Establish VPN connection between Samsung Cloud Platform and AWS.

## 1. Create AWS EFS
In AWS Console, Create File System > Customize </br>

<img width="601" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5146b79a-73f3-4783-a26d-83de46cee360"> <br>

Type Name of File system like: efsce and click [Next] </br>
<img width="1641" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/877d31e9-d994-404a-a664-646e1ede6341"> <br>

Configure VPC, Subnet and Security Group and click [Next] </br>
<img width="1313" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ac2d5872-74fa-4e22-b6e1-92ff059ba289"> <br>

Leave File system policy without change and click [Next] </br>
<img width="1311" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/95d0fef3-876b-4734-8aa7-b69e101fa8b8"> <br>

Review and Create</br>
<img width="1341" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c3eb1893-5061-4a15-971a-a7f647131c96">
<img width="1335" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/41a65904-28d8-4372-bffd-acf996889c97"> <br>


If you use default security group(open all), you can pass configuring security group.

If you use your own security group, you need to allow 2049 port.

<img width="1430" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d42de4be-a768-4ad1-af84-48c09772e8e4"> <br>


## 2. Establish VPN connection between Samsung Cloud Platform and AWS

In AWS console,<br>

VPC > Virtual Private Gateway > Create Virtual Private Gateway</br>
<img width="740" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d7b19d03-793f-42d7-9a97-b4e63b7abe7f"> <br>

Attach Virtual Private Gateway to VPC

<img width="1454" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/45b272ce-2df5-4ae3-bfec-ef5c9d881f7a"> <br>

Configure Route Table: Change route table to forward outbound traffic for VPN Gateway 
<img width="1429" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a3f1c242-f51b-4249-bc0b-37fd188f7a42"> <br>

In Samsung Cloud Platform console,<br>
Resource Management > Networking > VPN and click [Request] </br>
Type VPN Gateway name, Local Subnet(CIDR) then [Next] and [Complete]
<img width="1111" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7840cf43-3d23-4d67-bb40-9b515678806c"> <br>

Check and memorize Public IP of VPN Gateway <br>
<img width="1400" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/7237e6d9-375d-4cf6-b00b-af7d5cfa2f32"> <br>

In AWS console,</br>
VPC > Customer Gateways > Create customer gateway</br>
<img width="1470" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b0dc9ecc-9147-41b3-b359-4860bd939ce4">  <br>

Type name of customer gateway and Public IP address that was memorized above at Samsung Cloud Platform VPN <br>
<img width="744" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/276fd4e5-39df-47e8-bedc-e6881b25965c"> <br>

VPC > Site to Site VPN connections > create VPN connections <br>
<img width="1703" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/aafda41d-c13c-4209-99d0-e4acf6384c3c"> <br>

Type name and select Virtual Private Gateway created. Then, click [Create VPN connection] <br>
<img width="555" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c52363fb-34a7-4f8a-a5be-5d7bb09185a3"> <br>

Click [Download configuration] <br>
<img width="1516" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c5a2f145-a46f-4574-9144-1f94e748e777"> <br>

Select Fortigate and remain fields and click [Download] <br>
<img width="393" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/2b38cbd6-6869-44fa-a4d8-b641a3de402c"> </br>

Check configuration file<br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b8c2a064-5ed1-4059-8be2-3a1d68b35c33)<br>

In Samsung Cloud Platform console. </br>
Resource Management > Networking > VPN > VPN Tunnel > [Request] </br>
Referring AWS configuration file, type in the fields.

<img width="771" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3bdc4ec9-3ce6-4b79-915d-5e5479829e2e">

Check [UP] status connection between Samsung Cloud Platform VPN Tunnel and AWS Site to Site


## Request Virtual Server for migration server 

Create Virtual Server(CentOS) for File Storage Migration task.

Resource Management > Netwroking > VPN > Local Subnet , click [Create VPN connection] and add Virtual Server previously created 
<img width="1375" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e37faa74-a4ad-4076-b441-106c44eaf07e"><br>

Check and memorize IP and Mac address
<img width="1386" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/225a8156-6071-4e23-be80-d98ada4f9e1e"></br>

SSH connect to Virtual Server and type command.
```bash
ip addr
```
Find and memorize network adapter name that match with Mac address memorized above and create configuring file for the adapter.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9294a0b1-8708-4e06-a8b9-ac89895f8764)<br>
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f3ad567c-e0a9-4511-b7ac-06f3e8330999)<br>

Type the command and below config 

```bash
sudo vi /etc/sysconfig/network-scripts/ifcfg-[Network Adapter name]
```
Type below infomation
```bash
TYPE=Ethernet
BOOTPROTO=static
IPADDR=[IP address]          # You should input IP address memorized above
PREFIX=24
NAME=[Network Adapter name]  # You should input adapter name memorized above
DEVICE=[Network Adapter name]
ONBOOT=yes
```

After exiting vi, add routing table

```bash
sudo vi /etc/sysconfig/network-scripts/route-[Network Adapter name]
```
Type below information
```bash
[AWS VPN Local IP address] via [Samsung Cloud Platform VPN gateway address]
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/377d1038-2a4b-4c06-bf4e-b0d86f14b952)<br>

After exiting vi, type command

```bash
sudo systemctl restart network
```
## 3. Create Samsung Cloud Platform File Storage

- Add Virtual Server created bove in the [Servers to be applied]
- Memorize [Mount Information]

## 4. Mount SCP and AWS Storages to Virtual Server
### Mount Samsung Cloud Platform File Storage</br>
SSH connection to Virtual Server and type commands</br>

```bash
sudo yum install nfs-utils -y                                            # Install nfs utils
sudo mkdir /files                                                        # Create directory for [mount path]
sudo mount -t nfs -o vers=3,noresvport [Mount Information] [mount path]  # Mount Samsung Cloud Platform File Storage
```
### Mount AWS EFS

Type commmands

```bash
sudo mkdir /efs                                                          # Create directory for [mount path]

```

In AWS console check the NFS client mount command and type in Virtual Server

<img width="1606" alt="image" src="https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/17295aa5-2169-479a-9d1e-c712f4ea7974">

check mount result

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/375b56fe-1087-45ef-9235-ff90e140bd74)<br>


## 4. File Migration with rsync 

Install rsync
```bash
sudo yum install rsync -y
```

Type command to migrate file from AWS to SCP
```
sudo rsync -avzh --delete [source경로] [destination경로]
```
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/dacbd225-87ba-4a0d-b0e0-c34c2adfa16c)<br>
