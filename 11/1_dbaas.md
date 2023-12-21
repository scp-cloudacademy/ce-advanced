# 1. Create HA Mysql(DBaaS) 
#### Configuration
```
version: 8.0.33
server name: dba
cluster name: dbcla
* HA: check
database name: cosmetic
user: vmuser
pw: 
DataBase Port: 2866 (default)
```
# 2. Add Security Group rule
1) [BastionSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/11_bastion_security_group.xlsx)
2) [AppSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/11_app_security_group.xlsx)
3) [DBSG](https://github.com/scp-cloudacademy/ce-advanced/raw/main/11/11_db_security_group.xlsx)

# 3. Test Connection with workbench

# 4. Change DNS 
DB DNS record to DBaaS VIP 
