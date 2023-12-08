# File storage에 저장된 콘텐츠를 Object Storage로 Migration
## 1. object Storage 생성
configuration
1) Multi AZ: 사용
2) 제공범위: 공용

준비사항 </br>
1> 버킷 명 </br>
2> 퍼블릭 Url </br>
3> 인증키 (Access key, Security key) </br>

## 2. File migration
AWS Cli를 이용 </br>
※ 아직 설치가 되어있지 않다면, [다운로드](https://aws.amazon.com/ko/cli/)클릭하여 다운 및 설치를 진행한다.</br>

### (1) AWS Cli configuration
    aws configure
    access key 
    secret Access key
### (2) 명령어 입력
    aws s3 sync [폴더경로] s3:\\webce\ --endpoint-url [public url]
### (3) 업로드 된 폴더리스트 파일경로 지정
    public Acess 권한부여
### (4) Source code 반영
    index.php 의 파일경로를 [./web] → [endpoint/버킷명] 일괄변경
