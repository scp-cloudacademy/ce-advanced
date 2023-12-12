#Regoster Kubernetes Cluster 
## Check CMP-Token

    kubectl get secret -n=kube-system

## Check K8s CA Certificate

    kubectl get secret -n=kube-system cmp-token -ojsonpath='{.data.ca\.crt}'

## Check Admin Token

    kubectl describe secret -n=kube-system cmp-token 

