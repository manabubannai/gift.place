# thanks_webapp
## Descriptions


## How To Set Up This App

1. Copy .env.example to .env
2. Run `composer install`
3. Run `npm install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate`


## Start server

For local,
```
php artisan serve
```

## Front-end Dev

- For development
```
npm run dev
```
```
npm run watch
```

## elastic beanstalk

アプリケーションをアップロードするだけで、ロードバランサ(ELB)、実行環境(EC2)、設定(環境変数など)、可用性やスケールアウト(Auto Scaling)、監視(CloudWatch, SNS)、といった一般的なアプリケーションが動作するために必要な要素を一通り揃えた環境が作成され、その環境に対するデプロイや運用の支援ツールが提供されます。
Elastic Beanstalk(以降 EB) で生成される EC2 などの各リソースに関しては当然利用料金が発生しますが、 EB 自体は無料で利用できます。

インスタンスの種類やサイズ、オートスケーリングの条件など、構成・設定の大半はカスタマイズ可能

https://xtech.nikkei.com/it/atclncf/service/00033/031400001/



[デプロイフロー]
1. 必要な権限を付与した、IAMユーザーを作成する
2. プロジェクト配下で、`aws configure --profile directone` を実行する。
AWS Access Key ID、AWS Secret Access Key、リージョンを聞かれるので、以下の ように入力する。
-AWS Access Key ID: 上記で作成したIAMユーザーのAWS Access Key ID
-AWS Secret Access Key: 上記で作成したIAMユーザーのAWS Secret Access Key -Default region name:ap-northeast-1
-Default output format: Enterを押す

3. `eb init --profile directone` を実行する。これでElastic Beanstalk 環境とソー スコードのローカルリポジトリが紐づく。
4. `eb list` を実行してみると、Elastic Beanstalk環境の環境ごとのアプリケーションを確認できる。
5. git commit した後、 `eb deploy` を実行することで、デプロイを実行できます。Elastic Beanstalkでは、 ローカルのソースコードがアップロードされます。


[SSH接続フロー]
1. キーペア directone.pem をローカルに落とし、~/.ssh/ に配置し`chmod 600 directone.pem` を実行する
2. プロジェクト配下で、eb ssh を実行する
3. `cd /var/app/current/` にアプリケーションが設置されています


eb コマンドのインストール

https://qiita.com/reflet/items/d4c4a1c3e5a87c9a2ac2


connect RDS via sequel pro

https://qiita.com/pieroplus/items/c0651030d9b12ad2aa65