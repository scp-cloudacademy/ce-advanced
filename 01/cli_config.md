# Configuring Samsung Cloud Platform ClI 

#### 1. Install JAVA from either one.
OpenJDK link or

    https://jdk.java.net/21/
    
Oracle JDK link

    https://www.oracle.com/kr/java/technologies/downloads/

#### 2. Setting JDK path to JAVA_HOME at Windows System Property

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/cf4bba6d-cbf7-4b9d-9ff1-0c55967025d8)


#### 3. Download SCP CLI

    https://cloud.samsungsds.com/openapiguide/#/docs/download

#### 4. List current CLI configuration

    scp-tool-cli configure list

#### 5. Set SCP API address

    scp-tool-cli configure set cmp-url https://openapi.samsungsdscloud.com

#### 6. Set SCP Access Keys 
example) scp-tool-cli configure set access-key MJ12125+s

    scp-tool-cli configure set access-key ${AccessKey} 

example) scp-tool-cli configure set access-secret Bk1fp6BlWGhN

    scp-tool-cli configure set access-secret ${AccessSecretKey} 

#### 7. List current project setting and set project to work at

    scp-tool-cli project list-project-summaries-v3

example) scp-tool-cli configure set project-id PROJECT-Q8ob-g8rt8pO

    scp-tool-cli configure set project-id ${ProjectID} 

#### 8. Project ServiceZone Infomation (ServicezoneID, BlockID)

    scp-tool-cli project list-service-zones-of-project-v3 --project-id ${ProjectID}  

#### 9. Create VPC

    scp-tool-cli vpc create-vpc-v3 --req "{  \"serviceZoneId\" : \"West ZoneID\",  \"vpcName\" : \"VPCa\"}" 
    scp-tool-cli vpc create-vpc-v3 --req "{  \"serviceZoneId\" : \"West ZoneID\",  \"vpcName\" : \"VPCb\"}"
    scp-tool-cli vpc create-vpc-v3 --req "{  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcName\" : \"VPCc\"}"

#### 10. Create Internet Gateway

     scp-tool-cli internet-gateway create-internet-gateway-v3 --request "{  \"firewallEnabled\" : true,  \"firewallLoggable\" : false,  \"internetGatewayType\" : \"SHARED\",  \"serviceZoneId\" : \"West ZoneID\", \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli internet-gateway create-internet-gateway-v3 --request "{  \"firewallEnabled\" : true,  \"firewallLoggable\" : false,  \"internetGatewayType\" : \"SHARED\",  \"serviceZoneId\" : \"West ZoneID\", \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli internet-gateway create-internet-gateway-v3 --request "{  \"firewallEnabled\" : true,  \"firewallLoggable\" : false,  \"internetGatewayType\" : \"SHARED\",  \"serviceZoneId\" : \"East-1 ZoneID\", \"vpcId\" : \"VPCc ID\"}"

#### 11. Create Subnet

###### 1. Bastion Subnet (Public)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.0.0/24\",  \"subnetName\" : \"BASTIONa\",  \"subnetType\" : \"PUBLIC\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.10.0/24\",  \"subnetName\" : \"BASTIONb\",  \"subnetType\" : \"PUBLIC\",  \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.20.0/24\",  \"subnetName\" : \"BASTIONc\",  \"subnetType\" : \"PUBLIC\",  \"vpcId\" : \"VPCc ID\"}"

###### 2. WEB Subnet (Private)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.1.0/24\",  \"subnetName\" : \"WEBa\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.21.0/24\",  \"subnetName\" : \"WEBc\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCc ID\"}"

###### 3. Application Subnet (Private)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.2.0/24\",  \"subnetName\" : \"APPa\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.22.0/24\",  \"subnetName\" : \"APPc\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCc ID\"}"

###### 4. DataBase Subnet (Private)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.3.0/24\",  \"subnetName\" : \"Dba\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.12.0/24\",  \"subnetName\" : \"Dbb\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.23.0/24\",  \"subnetName\" : \"Dbc\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCb ID\"}"

###### 5. Local Subnet (Private)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.4.0/24\",  \"subnetName\" : \"LOCALa\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.24.0/24\",  \"subnetName\" : \"LOCALc\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCc ID\"}"

###### 6. Kubernetes Subnet (Private)

    scp-tool-cli subnet create-subnet-v2 --req-vo "{  \"subnetCidrBlock\" : \"192.168.11.0/24\",  \"subnetName\" : \"K8sb\",  \"subnetType\" : \"PRIVATE\",  \"vpcId\" : \"VPCb ID\"}"

#### 12. Create Security Group

###### 1. Bastion Security Group

    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"BASTIONa\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"BASTIONb\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"BASTIONc\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCc ID\"}"

###### 2. Web Security Group

    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"WEBa1\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"WEBa2\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"WEBc1\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCc ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"WEBc2\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCc ID\"}"

###### 3. Application Security Group

    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"APPa1\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"APPa2\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"APPc1\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"APPc2\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCa ID\"}"

###### 4. DataBase Security Group

    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dba1\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dba2\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dbb1\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dbb2\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dbc1\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCc ID\"}"
    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"dbc2\",  \"serviceZoneId\" : \"East-1 ZoneID\",  \"vpcId\" : \"VPCc ID\"}"    

###### 5. Kubernetes Security Group

    scp-tool-cli security-group create-security-group-v3 --req "{  \"loggable\" : false,  \"securityGroupName\" : \"K8sb\",  \"serviceZoneId\" : \"West ZoneID\",  \"vpcId\" : \"VPCb ID\"}"

#### 13. Create LoadBalancer

    scp-tool-cli loadbalancer create-load-balancer-v3 --request "{  \"blockId\" : \"West BlockID\",  \"firewallEnabled\" : false,  \"isLoggable\" : false,  \"linkIpCidr\" : \"192.168.254.0/30\",  \"loadBalancerName\" : \"LBa\",  \"loadBalancerSize\" : \"SMALL\",  \"serviceIpCidr\" : \"192.168.5.0/27\",  \"serviceZoneId\" : \"West ZoneID\", \"vpcId\" : \"VPCa ID\"}"
    scp-tool-cli loadbalancer create-load-balancer-v3 --request "{  \"blockId\" : \"West BlockID\",  \"firewallEnabled\" : false,  \"isLoggable\" : false,  \"linkIpCidr\" : \"192.168.254.0/30\",  \"loadBalancerName\" : \"LBb\",  \"loadBalancerSize\" : \"SMALL\",  \"serviceIpCidr\" : \"192.168.15.0/27\",  \"serviceZoneId\" : \"West ZoneID\", \"vpcId\" : \"VPCb ID\"}"
    scp-tool-cli loadbalancer create-load-balancer-v3 --request "{  \"blockId\" : \"West BlockID\",  \"firewallEnabled\" : false,  \"isLoggable\" : false,  \"linkIpCidr\" : \"192.168.254.0/30\",  \"loadBalancerName\" : \"LBa\",  \"loadBalancerSize\" : \"SMALL\",  \"serviceIpCidr\" : \"192.168.25.0/27\",  \"serviceZoneId\" : \"East-1 ZoneID\", \"vpcId\" : \"VPCc ID\"}"

#### 14. Create File-Storage

    scp-tool-cli file-storage-new create-file-storage-v4 --create-file-storage-v4-request "{ \"diskType\" : \"HDD\",  \"fileStorageName\" : \"fsce\",  \"fileStorageProtocol\" : \"NFS\", \"productNames\" : [ \"HDD\" ],  \"serviceZoneId\" : \"East-1 ZoneID\"}"

#### 15. Create Object Storage

    scp-tool-cli file-storage-new create-file-storage-v4 --create-file-storage-v4-request "{ \"diskType\" : \"HDD\",  \"fileStorageName\" : \"objce\",  \"fileStorageProtocol\" : \"NFS\", \"productNames\" : [ \"HDD\" ],  \"serviceZoneId\" : \"East-1 ZoneId\"}"
