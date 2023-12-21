# Migration contents from File storage to Object Storage
## 1. Create Object Storage

1) Multi-AZ : use
2) Scope : Public
3) Access control : Not use

After creating Object Storage, check the informations below.
1> Bucket name </br>
2> Public Url </br>
3> Access key (Access key, Access Security key) </br>

## 2. Migration from File Storage
In AWS Cli,  </br>
※ If it need to install, visit and install from https://aws.amazon.com/ko/cli/ </br>

### AWS Cli configuration

    aws configure
    access key 
    secret Access key

### Type commnands at Vitual Server

    aws s3 sync [path] s3:\\webce\ --endpoint-url [SCP Object Storage public url]

### In Samsung Cloud Platform Object Storage console and folders list

    Allow anonymous user to download file
    
### Change the path of contents in App Server
In index.php file, change the path from [./web] to [endpoint/bucket]

### Apply Source code to App Server
    cd /usr/share/nginx/html
   
### Create index.php with new version of source 
    sudo vi index.php1                   
    sudo chown vmuser:vmuser index.php1   
    sudo chmod 755 index.php1    
    sudo mv index.php index.php.back    
    sudo mv index.php1 index.php    
    sudo systemctl restart php-fpm   
    
### Check the page
### Apply to other App Server
    
    
