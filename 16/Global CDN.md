##### 1. Global CDN 생성하기
[CDN 가이드](https://cloud.samsungsds.com/manual/ko/scp_user_guide.html#getting_started_with_global_cdn)

가이드를 참고하여 생성하면 된다. 이때 주의사항은 Forward host header 및 Cache key hostname은 Origin Hostname으로 설정해준다.</br>
CDN 생성이 완료가 되면, 방화벽 또는 Security Group 설정이 필요한 경우 추가 설정을 해주면 된다.

##### 2. HTTPS 무료인증서 발급받기
[인증서 발급 참고](https://blog.jiniworld.me/137#a02-1)

1) 레포지토리 조회
  yum repolist | grep epel


