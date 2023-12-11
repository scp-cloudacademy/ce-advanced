
## Buid Image with Docker file

### Download docker file at the bastion

https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb.dockerfile

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
    
    kubectl apply -f service-nodeport.yaml
    
    kubectl get svc -n ceweb

    kubectl get endpoints -n ceweb   

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb_HTTP_PORT

    kubectl create configmap port-config -n ceweb --from-file=ceweb_HTTP_PORT 

## Allow K8s Servers in Private Endpoint Access Control

## Secret to allow k8s cluster to access SCR
secret name : cewebsecret

namespace : ceweb

Server: SCR Private Endpoint 


    kubectl create secret docker-registry cewebsecret --docker-server=<your-registry-server> --docker-username=<your-SCP-console-ID> --docker-password=<your-SCP-console-password> -n ceweb 

## Deploy web image to K8s cluster

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/deployment-ceweb.yaml
    
    kubectl apply -f deployment-ceweb.yaml

    kubectl get deployment -n ceweb



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
