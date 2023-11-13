<h1>VM migration</h1> 

VMware Workstation Pro 17 다운로드 링크</br>
https://www.vmware.com/kr/products/workstation-pro/workstation-pro-evaluation.html
</br>
</br>
</br>

<h3>vm tools 설치</h3>

```bash
sudo apt-get update –y                     # 업데이트 (필요한 경우에 진행)
sudo apt-get install open-vm-tools         # vm tools 설치
sudo apt-get install perl –y               # perl 패키지 설치
sudo reboot now                            # 재부팅
```
</br>

<h3>방화벽 포트 오픈</h3>

```bash
$ firewall-cmd --zone=public --permanent --add-port=22/tcp    # 22번 포트 오픈
$ firewall-cmd --zone=public --permanent --add-port=80/tcp    # 80번 포트 오픈
$ firewall-cmd --reload                                       # 리로드
$ firewall-cmd --zone=public --list-all                       # 리스트 불러오기
```
</br>

<h3>httpd 설치</h3>

```bash
$ yum install httpd -y               # web 설치
$ systemctl start httpd              # web 시작
$ hostname -I                        # IP 확인
```
</br>

<h3>버전 확인</h3>

```bash
$ cat /etc/*release*                 # OS 버전 확인
```
</br>

$$ OVA 파일 Object Storage에 업로드 하기

    aws s3 cp (파일명) s3://(버킷명)/ --endpoint-url (Public Endpoint명)
    
