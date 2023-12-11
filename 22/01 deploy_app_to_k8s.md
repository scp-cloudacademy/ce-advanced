
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

    kubectl create configmap port-config -n cemall --from-file=ceweb_HTTP_PORT 

## Allow K8s Servers in Private Endpoint Access Control

## Deploy web image to K8s cluster

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/deployment-ceweb.yaml
    
    kubectl apply -f deployment-ceweb.yaml



