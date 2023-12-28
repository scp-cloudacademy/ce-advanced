# Mount File Storage to HA servers

## 1. Test File upload 

## 2. Create File Storage 

※ Check list after creation
1) Check mount information 
2) Applied server
````
cd /usr/share/nginx/html
````
## 3. Mount Server

#### 1. move data
    sudo mv web web1
#### 2. Create directory
    sudo mkdir web
#### 3. Install nfs-util
    sudo yum -y install nfs-utils
#### 4. Mount at servers
    sudo mount -t nfs -o vers=3 [Mount information] [Mount path]    
    df -h    
#### 5. move data to shared volume
    sudo mv web1/* web
#### 6. Configure permission
    sudo chmod 777 file

