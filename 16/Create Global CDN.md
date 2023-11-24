## 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn) : 가이드를 참고하여 생성하면 된다. </br>

모든상품 ▶ Newrorking ▶  Global CDN 상품신청 

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d278cef3-6145-4b60-8330-c152282ae456)
사용할 CDN 명과 도메인을 설정 후 다음으로 넘어간다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/1fa99b89-2cb5-4c61-b9b7-5ce7c4f5a224)
CDN과 연결할 원본을 설정해준다.</br>

※ 서비스 프로토콜과 원본 프로토콜은 동일하게 설정해야하며, HTTPS 설정 시 Global CDN에서 원본 서버의 인증서 유효성을 확인한다.</br>
   원본경로는 실제 서비스로 제공될 원본 파일이 위치한 디렉토리 위치를 지정해준다.

![image](https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/029c935e-bb02-45d2-94f0-45183d3487c7)
마지막으로 캐싱설정을 해주면 Global CDN 생성이 완료가 된다.

* Global CDN은 프로젝트 당 여러개의 Global CDN 서비스를 신청할 수 있다.
* Global CDN 서비스 당 원본위치는 1개만 설정할 수 있다.
* Global CDN 사용을 위해서는 원본서버에 대한 Firewall 및 Security Group에 규칙을 추가해야 할 수 있다.
