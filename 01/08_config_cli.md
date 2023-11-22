# Building Server Image

  **Scenario :** Cosmetic Evolution IT Administrator's Management PC

  **Hands-on Location :** Your Labtop

  **Prerequisition :** Windows 10 above

---

### 1. Install JAVA from either one.
OpenJDK link or

    https://jdk.java.net/21/
    
Oracle JDK link

    https://www.oracle.com/kr/java/technologies/downloads/

Setting JDK path to JAVA_HOME at Windows System Property

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/cf4bba6d-cbf7-4b9d-9ff1-0c55967025d8)

### 2. CLI download
[SCP CLI Download Link](https://cloud.samsungsds.com/openapiguide/#/docs/download)

### 3. Create Accesskey (In Management Console)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/3a75925a-9698-41d7-905e-eb1198513321)
![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/79395f9b-ec46-4d40-9f7f-3edda07ce31d)

### 4. List current CLI configuration

    scp-tool-cli configure list

### 5. Set SCP API address

    scp-tool-cli configure set cmp-url https://openapi.samsungsdscloud.com

### 6. Set SCP Access Keys 
example) scp-tool-cli configure set access-key MJ12125+s

    scp-tool-cli configure set access-key ${AccessKey} 

example) scp-tool-cli configure set access-secret Bk1fp6BlWGhN

    scp-tool-cli configure set access-secret ${AccessSecretKey} 

#### 7. List current project setting and set project to work at

    scp-tool-cli project list-project-summaries-v3

example) scp-tool-cli configure set project-id PROJECT-Q8ob-g8rt8pO

    scp-tool-cli configure set project-id ${ProjectID} 
