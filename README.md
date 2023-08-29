## ルール
- カスタムルールよりAppServiceProviderでの追加を優先(https://tobilog.net/7077/#toc1)
- シングルアクションコントローラーを採用
- Enumを採用
- APIの検索は「パラメータ_lt, _gle, などを採用」
　モデルの「$searches」に登録して「searchByDefined」を使うと自動で登録される
- 例外ハンドラの登録推奨
- 戻り値はJsonResponse型を使う（ResponseUtils.php）を参照
- バリデーションはFormRequestを採用
- 認証はSanctumを採用（クッキー認証の方）
　ソーシャル認証の方もこれで行きたい
- 認可はポリシーを採用
- サービス層は作らない（必要なら作るがシングルアクションコントローラを生かす）
- リテラルはlangで全て扱う
- バッチはコンソールを採用


## ローカル環境でのwebhook利用方法

* stripeの管理画面にてwebhookイベントを拾うURLを指定する必要があるためローカルのapiサーバを外部公開する必要があります。
  外部公開するためにngrokというツールを利用してください
  * 導入手順は以下を参考にしてください
    * [導入手順参考](https://qiita.com/mininobu/items/b45dbc70faedf30f484e)

### 設定手順

1. ngrokを以下のコマンドで起動
    * ngrok http 8080
1. stipe管理画面にアクセス
    * https://dashboard.stripe.com/login
1. 開発者 → Webhookを選択しwebhook設定画面を表示
    * 表示されている環境がテスト環境であること
1. 表示されるオンラインエンドポイントのうち以下のURLを選択
    * https://{FQDN}/stripe/webhook
1. ページ右部の … を選択し詳細情報の更新を選択
1. エンドポイントURLの{FQDN}をngrok起動時に表示されるhttpsのURLに更新する

#### 注意事項

* ngrokが生成するURLは毎回ユニークです。再起動のたびに上記設定手順を実施してください