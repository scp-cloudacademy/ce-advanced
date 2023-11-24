## 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn)

* 가이드를 참고하여 생성하면 된다. </br>

모든상품 ▶ Newrorking ▶  Global CDN 상품신청 

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d278cef3-6145-4b60-8330-c152282ae456)
사용할 CDN 명과 도메인을 설정 후 다음으로 넘어간다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1fa99b89-2cb5-4c61-b9b7-5ce7c4f5a224)
CDN과 연결할 원본을 설정해준다.</br>

※ 




이때 주의사항은 Forward host header 및 Cache key hostname은 Origin Hostname으로 설정해준다.</br>
원본설정의 프로토콜은 2가지 중 등록할 도메인의 프로토콜에 맞춰 선택을 해주면 된다.</br>
CDN 생성이 완료가 되면, 원본서버에 대한 firewall 및 Security Group에 허용규칙을 추가해준다.

