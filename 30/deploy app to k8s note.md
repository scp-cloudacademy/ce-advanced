


Kubernetes 에 SCR 로 push 해둔 nginx image 를 배포하기에 앞서 Container Registry 
Image 를 사용하기 위해 다음과 같이 Secret 을 생성하겠습니다. 배포할 deployment 와
secret 은 동일한 namespace 에 위치해야 합니다.

Copyright 2023. Samsung SDS Co., Ltd. All rights reserved. 10
$ kubectl create secret docker-registry <<secret name>> \
--docker-server=<your-registry-server> \
--docker-username=<your-SCP-console-ID> \
--docker-password=<your-SCP-console-password> \
-n <<nameSpace name>> 
docker-server 에 입력할 Container Registry 주소는 SCP Console 에서 확인할 수
있습니다.
Container > Container Registry > Container Registry 상세 – 프라이빗 엔드포인
