
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

## Deploy Image to Kubernetes Cluster
Download YAML file run the deploymet command at the bastion

https://github.com/scp-cloudacademy/ce-advanced/raw/main/22/nginx_deployment.yaml

    sudo kubectl apply -f nginx_deployment.yaml
    

# Service API 버전: v1
# Service 이름: ceweb
# Service 네임스페이스: cemall
# Service 레이블: service=ceweb, project=cemall
# Service 타입: NodePort
# Service 셀렉터: service=ceweb, project=cemall
# Service 포트: 80
# 컨테이너 포트: 8080

---

apiVersion: apps/v1
kind: Deployment
metadata:
  name: ceweb
  namespace: cemall
  labels:
    service: ceweb
    project: cemall
spec:
  selector:
    matchLabels:
      service: ceweb
      project: cemall
  template:
    metadata:
      labels:
        service: ceweb
        project: cemall
    spec:
      containers:
      - name: ceweb
        image: yoonjeong/ceweb:v1
        ports:
        - containerPort: 31515
        resources:
          limits:
            memory: "64Mi"
            cpu: "50m"


# cemall
kubectl apply -f backend

# Ingress / IngressController 생성 - Ingress 리소스를 생성하면 GKE가 구글 클라우드의 HTTP 로드밸런서를 이용해서 Ingress Controller를 생성한다 
kubectl apply -f ingress-multiple-hosts.yaml

# snackbar 네임스페이스에 모든 리소스 확인
kubectl get all -n snackbar

# 서비스 엔드포인트 확인
kubectl get endpoints -n snackbar

# 생성한 Ingress 리소스 확인 - ADDRESS: Ingress Controller의 IP 확인
kubectl get ingress snackbar -n snackbar

# Ingress Address와 Host 헤더로 요청 실행
export INGRESS_IP=$(kubectl get ingress snackbar -n snackbar -o jsonpath="{.status.loadBalancer.ingress[0].ip}")

# ===== ingress multiple hosts =====
# 주문 홈
curl -H "Host: order.fast-snackbar.com" --request GET $INGRESS_IP
# 주문 메뉴 조회
curl -H "Host: order.fast-snackbar.com" --request GET $INGRESS_IP/menus
# 주문 요청
curl -H "Host: order.fast-snackbar.com" --request POST $INGRESS_IP/checkout \
--header 'Content-Type: application/json' \
--data-raw '{
    "Pizza": 1,
    "Burger": 2,
    "Coke": 0,
    "Juice": 0
}'

# 결제 홈
curl -H "Host: payment.fast-snackbar.com" --request GET $INGRESS_IP
# 결제 정보 조회
curl -H "Host: payment.fast-snackbar.com" -s --request POST $INGRESS_IP/receipt \
--header 'Content-Type: application/json' \
--data-raw '{
    "Pizza": 1,
    "Burger": 2,
    "Coke": 0,
    "Juice": 0
}' | json_pp

# 배달 홈
curl -H "Host: delivery.fast-snackbar.com" $INGRESS_IP

# 디폴트 백엔드 - 선언하지 않은 Host 헤더와 Path로 요청 실행 
curl -H "Host: wrong.fast-snackbar.com" $INGRESS_IP
curl -H "Host: wrong.fast-snackbar.com" $INGRESS_IP/abc

# ===== ingress single hosts =====

# Ingress 업데이트
kubectl apply -f ingress-single-host.yaml

# Ingress Address와 URL Path로 요청 실행

# 주문 홈
curl --request GET $INGRESS_IP/order

# 주문 메뉴 조회 
curl --request GET $INGRESS_IP/order/menus

# 주문 요청
curl --request POST $INGRESS_IP/order/checkout \
--header 'Content-Type: application/json' \
--data-raw '{
    "Pizza": 1,
    "Burger": 2,
    "Coke": 0,
    "Juice": 0
}'

# 결제 홈
curl --request GET $INGRESS_IP/payment

# 결제 정보 조회
curl -s --request POST $INGRESS_IP/payment/receipt \
--header 'Content-Type: application/json' \
--data-raw '{
    "Pizza": 1,
    "Burger": 2,
    "Coke": 0,
    "Juice": 0
}' | json_pp

# 선언하지 않은 Path로 요청 실행 
curl $INGRESS_IP/not-found

# 메뉴조회 로드밸런싱 확인
for i in {1..10};
do curl $INGRESS_IP/order/menus;
done

# snackbar 네임스페이스에 project=snackbar 레이블을 가진 모든 리소스 제거
kubectl delete all -l project=snackbar -n snackbar
