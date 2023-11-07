<h1>Object Storage Migration</h1>

<h3>Rclone 설치</h3>

```bash
$ curl https://rclone.org/install.sh | sudo bash
```

<h3>Rclone 구성</h3>

```bash
$ rclone config
```

<h3>Migration 수행</h3>

```bash
$ rclone ls [config name]:[bucket name]
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --dry-run --progress
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --progress
```
