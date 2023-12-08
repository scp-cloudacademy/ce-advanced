# Create and Connect Kubernetes Cluster

  **Scenario :** 

  **Hands-on Location :** Your Labtop

  **Prerequisition :** 

---


## 1. Update Repo

    sudo yum install -y yum-utils
    sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

### 2. Install and start Docker

    sudo yum install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
    sudo systemctl start docker
    sudo docker pull nginx


### 3. Container Registry Login

    sudo docker login <<SCR private endpoint>


### 4. Push Image to Container Registry 

    sudo docker tag nginx <<SCR private endpoint>>/sample/nginx:v1

    sudo docker push nginx <<SCR private endpoint>>/sample/nginx:v1

### 5. Test deploying SCR image to Kubernetes Cluser 

    kubectl create namespace cemall

secret name : cecred
namespace : cemall
docker-server : <<SCR private endpoint>>

     kubectl create secret docker-registry <<secret name>> \
    --docker-server=<your-registry-server> \
    --docker-username=<your-SCP-console-ID> \
    --docker-password=<your-SCP-console-password> \
    -n cemall

### 6. Create and apply Nginx deployment file  

    sudo vi nginx-deployment.yaml

Copy and Paste below yaml text

```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: nginx-deployment
  namespace: scrtest
spec:
  selector:
    matchLabels:
      app: nginx
  replicas: 2
  template:
    metadata:
      labels:
        app: nginx
    spec:
      containers:
      - name: nginx
        image: <<SCR private endpoint>>/sample/nginx:v1   # 콘솔에서 scr image 확인 후 변경
      imagePullSecrets:
      - name: cecred                                      # 위에서 생성한 secret name 작성
```

Apply nginx-deployment.yaml

    kubectl apply –f nginx-deployment.yaml

Check deplpoymnet

    kubectl get deploy,pod –n scrtest

