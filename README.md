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
- 