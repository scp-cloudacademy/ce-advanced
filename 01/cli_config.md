
#### 현재 CLI의 구성 상태를 확인합니다.

    scp-tool-cli configure list

#### SCP의 API 주소를 설정합니다.

    scp-tool-cli configure set cmp-url https://openapi.samsungsdscloud.com

#### SCP의 인증키의 시크릿 키를 등록합니다. 
예시) scp-tool-cli configure set access-key MJ12125+s

    scp-tool-cli configure set access-key ${AccessKey} 

#### SCP의 인증키의 액세스 시크릿 키를 등록합니다. 
예시) scp-tool-cli configure set access-secret Bk1fp6BlWGhN

    scp-tool-cli configure set access-secret ${AccessSecretKey} 

#### 현재 지정된 프로젝트를 조회합니다.

    scp-tool-cli project list-project-summaries-v3

#### SCP에서 자원을 생성 관리할 프로젝트를 지정합니다.
예시) scp-tool-cli configure set project-id PROJECT-Q8ob-g8rt8pO

    scp-tool-cli configure set project-id ${ProjectID} 
