# Samsung Cloud Platform ClI 환경 구성하기

#### 1. JAVA를 설치합니다.
OpenJDK link 또는

    https://github.com/ojdkbuild/ojdkbuild
    
Oracle JDK link

    https://www.oracle.com/kr/java/technologies/downloads/

#### 2. JDK 설치 경로를 시스템의 환경변수 JAVA_HOME으로 지정

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/48bc889c-8020-4780-a8c3-aaa06d5f2337)


#### 3. SCP의 CLI를 다운로드하여 압축해제합니다.

    https://cloud.samsungsds.com/openapiguide/#/docs/download

#### 4. 현재 CLI의 구성 상태를 확인합니다.

    scp-tool-cli configure list

#### 5. SCP의 API 주소를 설정합니다.

    scp-tool-cli configure set cmp-url https://openapi.samsungsdscloud.com

#### 6. SCP의 인증키를 등록합니다. 
예시) scp-tool-cli configure set access-key MJ12125+s

    scp-tool-cli configure set access-key ${AccessKey} 

예시) scp-tool-cli configure set access-secret Bk1fp6BlWGhN

    scp-tool-cli configure set access-secret ${AccessSecretKey} 

#### 7. 현재 지정된 프로젝트를 조회하고 자원을 생성 관리한 프로젝트를 지정합니다.

    scp-tool-cli project list-project-summaries-v3

예시) scp-tool-cli configure set project-id PROJECT-Q8ob-g8rt8pO

    scp-tool-cli configure set project-id ${ProjectID} 
