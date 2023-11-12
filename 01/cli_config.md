# Samsung Cloud Platform ClI 환경 구성하기

#### 1. Install JAVA from either one.
OpenJDK link or

    https://github.com/ojdkbuild/ojdkbuild
    
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
