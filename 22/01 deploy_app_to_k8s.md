
## Buid Image with Docker file

### Download docker file at the bastion

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb.dockerfile

### Buld docker Image

    sudo docker buildx build -t ceweb -f ceweb.dockerfile .

### Run docker cotainer with image

    sudo docker run -d -p 80:80 ceweb

## Push Image to Container Registry

    sudo docker tag ceweb cecr-goqhrszn.scr.kr-west.scp-in.com/app/ceweb:v1
    sudo docker push cecr-goqhrszn.scr.kr-west.scp-in.com/app/ceweb:v1

## Create namespace

    kubectl create namespace ceweb

## Download and apply service.yaml to create service nodeport

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/service-nodeport.yaml

서비스 노드 포트 생성

    kubectl apply -f service-nodeport.yaml

생성 확인

    kubectl get svc -n ceweb

엔드포인트 없음 확인

    kubectl get endpoints -n ceweb   

ConfigMap 다운로드

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb_HTTP_PORT

ConfigMap 설정

    kubectl create configmap port-config -n ceweb --from-file=ceweb_HTTP_PORT 

## Allow K8s Servers in Private Endpoint Access Control

## Secret to allow k8s cluster to access SCR
secret name : cewebsecret

namespace : ceweb

Server: SCR Private Endpoint 


    kubectl create secret docker-registry cewebsecret --docker-server=<your-registry-server> --docker-username=<your-SCP-console-ID> --docker-password=<your-SCP-console-password> -n ceweb 

## Deploy web image to K8s cluster

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/deployment-ceweb.yaml

이미지 파일 배포
    
    kubectl apply -f deployment-ceweb.yaml

배포 확인

    kubectl get deployment -n ceweb

엔드포인트 확인

    kubectl get endpoints ceweb-app -n ceweb

파드 현황 확인

    kubectl get pod -n ceweb

내부 포트 확인

    kubectl exec ceweb-1.0-7d9db75f56-6srsw -n ceweb -- printenv PORT

인그레이스 다운로드

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb-ingress.yaml

인그레스 개시

    kubectl apply -f ceweb-ingress.yaml

    
### Change Nodeport to LoadBalancer



### Check Created LB Service NAT IP and enroll DNS(cosmeticevolution.net) with ceweb A record

Browse http://ceweb.cosmeticevolution.net and find it fails and run command below and retry

    kubectl port-forward service/ceweb-app 8080:80 -n ceweb

   
   



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
