
Rclone 설치
$ curl https://rclone.org/install.sh | sudo bash

Rclone 구성
$ rclone config

Migration 수행
$ rclone ls [config name]:[bucket name]
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --dry-run --progress
$ rclone sync [source config name]:[bucket] [target config name]:[bucket] --progress

