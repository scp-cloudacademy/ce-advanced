# Create and Connect Kubernetes Cluster

  **Scenario :** 

  **Hands-on Location :** Your Labtop

  **Prerequisition :** 

---


## Create Required Services

### 1. Create File Storage for K8s

    Name: fsb

### 2. Create Load Balancer for K8s

### 3. Create File Storage for API Server client 

    Server Name: lbastiondmz
    Image: CentOS
    Security Group: BASTIONdmzSG (allow 22 port inbound/outbound for servers in bastion subnet)
   

 

 
Kubectl Client Program을 다운로드 합니다.

    sudo curl -LO https://dl.k8s.io/release/v1.26.8/bin/linux/amd64/kubectl
(클러스터 버전과 일치할것을 권고, CLI와 클러스터 간 +-1 버전만 지원)
	다운로드 받은 client 프로그램 설치(root 사용자)
sudo install -o root -g root -m 0755 kubectl /usr/local/bin/kubectl
	다운로드 받은 client 프로그램 설치 (root 사용자가 아닐경우)
sudo chmod +x kubectl 
sudo mkdir -p ~/.local/bin
sudo mv ./kubectl ~/.local/bin/kubectl
	Kubectl version 명령어 활용하여 client / server 프로그램 확인
kubectl version

 
※	Kubectl Client는 Kubernetes 버전 및 host 환경을 고려하여 설치.
상세한 정보는 Kubernetes 커뮤니티에서 확인 가능
 https://kubernetes.io/ko/docs/tasks/tools/install-kubectl-linux/
 
③	위 커맨드 창에서 Client 버전은 확인 가능합니다. (curl로 설치 확인)
그러나, kubernetes 서버 접속은 못하고 있습니다.
(localhost:8080 접속하여 refused 상태)
따라서 KubeConfig 정보를 수정해야 서버 접속이 가능합니다.

6.3.2	KubeConfig 정보 세팅
①	모든 상품  Container  Kubernetes Engine  클러스터에서 자원관리 버튼을 선택합니다.
 
②	클러스터를 선택합니다.
 
③	클러스터 상세화면에서 프라이빗 엔드포인트 주소 및 kubeconfig 정보를 확인합니다.
 
④	kubeconfig 파일을 선택하여 클립보드에 복사합니다.
 
⑤	터미널 프로그램을 이용하여 클립보드에 저장한 KubeConfig 내용을 config 파일에 저장합니다.
 

⑥	터미널 프로그램으로 Bastion 서버에 접속하여 Kubernetes 서버와 통신을 확인합니다.
 
 
6.3.3	Kubernetes 클러스터 오브젝트 관리
①	Kubectl 명령어를 이용해서 클러스터 내 오브젝트를 관리합니다.
 
②	Kubectl 주요 명령어를 사용해 봅니다.

-	Kubectl command 모음 - https://kubernetes.io/ko/docs/reference/kubectl/cheatsheet/ 
 
