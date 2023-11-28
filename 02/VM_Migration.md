<h1>Migration Image</h1> 

사용 OS : CentOS 7.8</br>
사용 Tools</br>
VMware Workstation Pro 17</br>
다운로드 링크 : https://www.vmware.com/kr/products/workstation-pro/workstation-pro-evaluation.html</br>
AWS Cli</br>
다운로드 링크 : https://docs.aws.amazon.com/ko_kr/cli/latest/userguide/getting-started-install.html</br>
</br>
</br>
</br>

<h3>vm tools 설치</h3>

```bash
yum install open-vm-tools         # vm tools 설치
yum install perl –y               # perl 패키지 설치
reboot now                        # 재부팅
```
</br>

<h3>방화벽 포트 오픈</h3>

```bash
firewall-cmd --zone=public --permanent --add-port=22/tcp    # 22번 포트 오픈
firewall-cmd --zone=public --permanent --add-port=80/tcp    # 80번 포트 오픈
firewall-cmd --reload                                       # 리로드
firewall-cmd --zone=public --list-all                       # 리스트 불러오기
```
</br>


<h3>버전 확인</h3>

```bash
$ cat /etc/*release*                 # OS 버전 확인
```
</br>

<h3>OVA로 Export 하기</h3>

<h3>OVA 파일 Object Storage에 업로드 하기</h3>

```bash
aws s3 cp [파일명] s3://[버킷명]/ --endpoint-url [Public Endpoint명]
```

<h3>OVA 파일을 Migration Image로 만들기</h3>

<h3>Virtual Server 배포</h3>
