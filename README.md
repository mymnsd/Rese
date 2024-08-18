# Rese

「Rese」は飲食店予約アプリです。

会員登録をするとマイページが開設され、店舗の予約、お気に入りに追加、レビュー投稿、オンライン決済ができます。
また、管理者様用ページと店舗代表者様用ページも作成しております。

## 作成目的

laravel学習の総まとめとして作成しました。

与えられた要件やイメージをもとにテーブル作成、ER図、コーディングを行いました。

## 機能一覧

・ユーザー様、管理者様会員登録（名前、メールアドレス、パスワードを入力）

・ユーザー様、管理者様、店舗代表者様ログイン（メールアドレスとパスワードで認証）、ログアウト

・画像をストレージに保存

・リマインダーメール送信

・メール認証

・ユーザー様向け機能

　　*お気に入り登録、解除

　　*エリア、ジャンル、キーワードで店舗を検索

　　*店舗情報詳細を表示

　　*店舗の予約、変更、キャンセル

　　*レビュー投稿

　　*予約内容のQRコード生成
  
  　　*stripeでの決済

・管理者様は店舗代表者様を登録できます

・店舗代表者様向け機能

　　*新店舗追加、既存店の更新、削除

  　　*予約情報の照合

   　　*お知らせメール送信

## 使用技術

・PHP7.4.9

・laravel8

・MySQL8.0.26

## 環境構築

### Dockerビルド

  1.git clone git@github.com:mymnsd/rese.git

  2.DockerDesktopアプリを立ち上げる

  3.docker-compose up -d --build

### laravel環境構築

  1.docker-compose exec php bash

  2.composer install

  3.「.env.example」ファイルを「.env」ファイルに命名を変更。または、新しく.envファイルを作成

  4..envに以下の環境変数を追加

    DB_CONNECTION=mysql

    DB_HOST=mysql

    DB_PORT=3306

    DB_DATABASE=laravel_db

    DB_USERNAME=laravel_user

    DB_PASSWORD=laravel_pass

  5.アプリケーションキーの作成

    php artisan key:generate

## テーブル仕様書

![スクリーンショット (78)](https://github.com/user-attachments/assets/4feb9418-433d-44a8-a66b-fb53091195cd)

![スクリーンショット (79)](https://github.com/user-attachments/assets/596292bc-8d3b-4ef8-9fa7-216de90917df)

![スクリーンショット (80)](https://github.com/user-attachments/assets/4bdeed37-9469-4282-986d-35d0cc9ca9bd)

![スクリーンショット (81)](https://github.com/user-attachments/assets/717d4803-75c8-43bf-bbb1-ad9fd595dcbc)

## ER図

![スクリーンショット (77)](https://github.com/user-attachments/assets/301d1ab3-97b4-45bc-a488-eb73cd600511)

## URL

開発環境：http://localhost/

phpMyAdmin:：http://localhost:8080/

















