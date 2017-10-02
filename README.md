# SQLInjectionTest-Docker
Dockerfile for SQLInjection Testing
簡単なSQLInjectionの例題と、mysqlのクエリログ、Slowログの設定が入ったイメージです。
ログにどのように出るのかの確認ができます。

## 起動
```
docker build -t local/sqltest .
docker run --privileged -d --rm -p 28080:80 --name sqltest local/sqltest 
```
http://localhost:28080/ でアクセス可能になります。

## ログの確認
ログの出力設定(デフォルトオフ)は/etc/my.cnfで有効に設定済みです。
```
docker exec -it sqltest /bin/bash
```
でOSに入れます。
```
$ tail -f /var/lib/mysql/mysql-slow.log
$ tail -f /var/lib/mysql/mysql-general.log
```
などでmysqlのログの確認が可能です。

## 停止
```
docker stop sqltest
```
または
```
docker kill sqltest
```
