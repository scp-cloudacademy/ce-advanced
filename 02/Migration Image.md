<h1>Migration Image</h1> 

OS : CentOS 7.8</br>
Tools</br>
VMware Workstation Pro 17</br>
Download Link : https://www.vmware.com/kr/products/workstation-pro/workstation-pro-evaluation.html</br>
AWS Cli</br>
Download Link : https://docs.aws.amazon.com/ko_kr/cli/latest/userguide/getting-started-install.html</br>
</br>
</br>

<h3>vm tools 설치</h3>

```bash
yum install open-vm-tools         # Install vm tools 
yum install perl –y               # Install perl Package
reboot now                        
```
</br>

<h3>Firewall for Web, App Server</h3> 

```bash
firewall-cmd --zone=public --permanent --add-port=22/tcp    # 22 for SSH Web/App
firewall-cmd --zone=public --permanent --add-port=80/tcp    # 80 for Web
firewall-cmd --reload                                       
firewall-cmd --zone=public --list-all                       
```
</br>


<h3>Check version</h3>

```bash
cat /etc/*release*                 
```
</br>

<h3>Export OVA file</h3>

<h3>Upload OVA file to Object Storage</h3>

```bash
aws s3 cp [file name] s3://[bucket name]/ --endpoint-url [Public Endpoint명]
```

<h3>Convert OVA file with Migration Image</h3>
Samsung Cloud Platform Console > Resource Management > Compute > Virtual Server > Migration Image<br>

<h3>Request Virtual Server</h3>
Samsung CLoud Platform Console > Resource Management > Compute > Virtual Server<br>
Select Image at [Migration] tap
