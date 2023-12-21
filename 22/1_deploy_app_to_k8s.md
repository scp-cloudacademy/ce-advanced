
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

create service nodeport

    kubectl apply -f service-nodeport.yaml

check status

    kubectl get svc -n ceweb

check no endpoints

    kubectl get endpoints -n ceweb   

Download ConfigMap 

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb_HTTP_PORT

Configure ConfigMap

    kubectl create configmap port-config -n ceweb --from-file=ceweb_HTTP_PORT 

## Allow K8s Servers in Private Endpoint Access Control

## Secret to allow k8s cluster to access SCR
secret name : cewebsecret

namespace : ceweb

Server: SCR Private Endpoint 


    kubectl create secret docker-registry cewebsecret --docker-server=<your-registry-server> --docker-username=<your-SCP-console-ID> --docker-password=<your-SCP-console-password> -n ceweb 

## Deploy web image to K8s cluster

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/deployment-ceweb.yaml

Deploy Image file
    
    kubectl apply -f deployment-ceweb.yaml

Check deployment

    kubectl get deployment -n ceweb

Check endpoint

    kubectl get endpoints ceweb-app -n ceweb

Check pod status

    kubectl get pod -n ceweb

Check internal port

    kubectl exec ceweb-1.0-7d9db75f56-6srsw -n ceweb -- printenv PORT

Download Ingress

    sudo wget https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/ceweb-ingress.yaml

Deploy Ingress

    kubectl apply -f ceweb-ingress.yaml

    
### Change Nodeport to LoadBalancer



### Check Created LB Service NAT IP and enroll DNS(cosmeticevolution.net) with ceweb A record

Browse http://ceweb.cosmeticevolution.net and find it fails and run command below and retry

    kubectl port-forward service/ceweb-app 8080:80 -n ceweb

   
