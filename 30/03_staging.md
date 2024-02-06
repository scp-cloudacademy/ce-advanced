<h1>VM Migration</h1>

<h3> Lab environment </br>
OS : CentOS 7.8 </br>
Source VM : VMware Workstation </br>
Bastion Host : Windows Server Virtual Server at VPCdmz
Before start lab, Create Windows Server Bastion Host referring the following guide.</br>
Reference:</br>
https://cloud.samsungsds.com/serviceportal/assets/pdf/ko/SDS_tutorial_KuberenetesNodeCLI_kor.pdf (Korean)</br>
https://cloud.samsungsds.com/serviceportal/assets/pdf/en/SDS_tutorial_KuberenetesNodeCLI_en.pdf (English)

- Request Target Server in Public Subnet(dbdmz1)
  require additional data disk
  
<h3> Firewall and Security Group rule</br>
  Management Portal: 58080 port</br>
  Agent : 50001, 50000 port</br>
  Migration : 50005 port</br>
  [Security Group](https://github.com/scp-cloudacademy/ce-advanced/raw/main/03/03_security_group_rules.xlsx) </br>
  [Internet Gateway Firewall](https://github.com/scp-cloudacademy/ce-advanced/raw/main/03/03_firewall_rules.xlsx)
  
<h3> Download and install ZConverter 
[Download](https://objectstorage.ap-seoul-1.oraclecloud.com/p/QNEde7RjRlPcPrASvpu9BEbuXbbW-3Y-HNccECLYlPySFVZLZlQ4XjPuxT45aOxI/n/idffti7li8cs/b/ZConverter_Bucket/o/ZConverter_CloudManager_Setup_v4.1_SCP.exe)

If the link doesn't work, contact sales@zconverter.com for download link.

<h3>Install Source Agent</h3>

```bash
wget http://[zconverter management portal server IP]:58080/Download/ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudSourceClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_source/
./install.sh
```

Type Enter

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/de093b96-737b-43ff-aae8-7aac1e811fad)<br>

Select 2. Select ZCM

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a4c44cde-37f1-48ac-bf31-a7a384664754)<br>

Input Management Portal IP

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/6b3d140d-4c57-41fc-b1ed-c9ccb62ae9af)<br>

Input Management Portal ID (scp@samsung.com)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ae5e605d-73a5-4d6f-a480-648eecace0fe)<br>


<h3>Install Target Agent</h3>

```bash
wget http://[zconverter 관리포탈]:58080/Download/ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
tar -xzf ZConverter_CloudTargetClient_Setup_V4.1_Build_4003.tar.gz
cd zconverter_install_target/
./install.sh
```

Type Enter

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/38d31953-4504-41db-a93b-1af50b23fd29><br>


Select 2. Select ZCM

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e6dc9346-1ce5-4fb1-bd9b-267bb9ee298b><br>

Input Management Portal IP

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3107e7ab-4247-4187-ad8a-f4962e76b0a8><br>

Input Management Portal ID (scp@samsung.com)

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/9eb4085f-82c2-4dec-aeb6-ed4f9e39daf4><br>

Check additional disk at Target VM for ZConverter storage. Type "Y"<br>

<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f24e959e-4365-4b44-96a5-89dcfee12c3b><br>


<h3>ZConverter</h3>
In Management Portal, Run migration by registering source server and target server<br>
<br>
In the browser, open Management Portal ( http://[management portal server public IP]:58080 ) with following ID and Password

  ID : scp@samsung.com

  PW : !mig2scp

In Dashboard menu, Setting(설정) > Environmnet Setting(환경설정)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a1f16857-a4c2-404d-9ca0-291bfa9f1497)<br>

Check and memorize ZCM ID in environment page

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b0412a68-e469-4e97-a363-fee55e47ef43)<br>

Request ZConverter license with ZCM ID<br>
License request page : https://ziacloud.net:55051/promotion

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/ddc03be2-6323-4821-8725-5313b0610089)<br>

Add license in setting(설정) > License(라이선스)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/76a69a69-28bc-4116-a569-c3dbc04982df)<br>

Check License

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/a22c74ad-801d-4c94-af7e-391ec7977360)<br>

In Cloud Migration(클라우드 마이그레이션) > Samsung(삼성), input Source VM information and click next(다음)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/0a28030b-67ba-44bb-81d9-70c46ad3b082)<br>

After input Target VM information and click next(다음)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c386bd71-7ca6-4ffa-b511-1cb979c28c66)<br>

Select the license

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/617536f3-1002-48f2-b3bf-8e6375eb76a1)<br>

Check port connection status, available storage space and confirm(확인)

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/44f41661-083e-430e-99ae-b6b514e1d98e)<br>

Proceeding migration.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/5b77eea6-ff80-419d-a363-6959a1edd584)<br>

Check completion page.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/22dcbf1c-3390-4f87-a21c-3e29b4d14134)<br>

