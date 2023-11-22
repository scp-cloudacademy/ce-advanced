<h1>Object Storage Migration</h1>

<h3>Rclone 설치</h3>

```bash
$ curl https://rclone.org/install.sh | sudo bash
```

<h3>Azure Rclone Remote 구성</h3>

```bash
$ rclone config
```
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b150088f-24d7-4311-8649-09c14a2f4c28><br>
n을 입력하여 신규 Remote를 생성<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/965e2a76-4a3e-453a-8500-efdba34583ea><br>
신규 Remote의 이름 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/bec1d8ea-f6b3-4825-994f-cbdbb56fd2cd><br>
Microsoft Azure Blob Storage를 선택<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c9d7bc0a-af18-414d-910b-9488bec1b6ab><br>
연결할 Blob Storage의 Storage Account를 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/89809ea5-90f0-4754-bc1c-2e1b0751c21f><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c30bfef6-23ff-4cf5-8c2b-c878e2ece17d><br>
Azure의 Storage Account의 액세스 키 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e21c548c-9a69-49c9-9766-0809a9f5dc14><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/41868a2f-1a97-47a6-b04c-5c8d961ed7c9><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/2847357a-2774-47f0-86be-68cb980dd54a><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/31a96583-7321-4cba-a940-9c572f7248b7><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d10a9b6d-53d7-4d14-ac16-ff1dbb54271d><br>
입력 정보 확인 후 맞다면 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/af13d55c-8255-458f-b56e-91e24902d8f5><br>
생성된 Azure Blob의 Remote 확인<br>

<h3>구성된 Rclone 확인</h3>

```bash
$ rclone ls [config name]:[bucket name]
```
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d9d2cbf6-2fb8-4de1-800a-5154bdb85e9b><br>
명령어 입력으로 확인할 경우 사진과 같이 bucket 내부의 Object를 출력합니다.

<h3>Samsung Cloud Platform Rclone Remote 구성</h3>

<h3>Migration 수행</h3>

```bash
$ rclone config
```


```bash
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --dry-run --progress
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --progress
```
