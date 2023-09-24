### 環境構築手順
1. `make init`でdockerのコンテナ、serverコンテナのnginxを起動する
2. POST: `http://localhost:8080/api/auth/signin` のAPIを次のパラメータで叩き `{"email": "user@lh.sandbox","password": "pass"}` でログインする。


### APIドキュメント
http://localhost:8888
### 操作ガイド
- 各コンテナを起動して、nginxを起動する `make start`
- データベースをリセットする `make db-fresh`
- nginxを起動する `make nginx-start`
- 
#### 注意事項
