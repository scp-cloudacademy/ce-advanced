#### 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn)

가이드를 참고하여 생성하면 된다. 이때 주의사항은 Forward host header 및 Cache key hostname은 Origin Hostname으로 설정해준다.</br>
원본설정의 프로토콜은 2가지 중 등록할 도메인의 프로토콜에 맞춰 선택을 해주면 된다.</br>
CDN 생성이 완료가 되면, 원본서버에 대한 firewall 및 Security Group에 허용규칙을 추가해준다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1876c216-9001-465b-a60a-2645387e5076)
