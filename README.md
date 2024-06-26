# Warwick Vocaloid Society WEBプロジェクト

<div align="center">
    <a href="https://www.warwicksu.com/societies-sports/societies/vocaloid/" target="_blank">
    <img src="https://www.warwicksu.com/asset/Organisation/72239/logo-noBG.png?thumbnail_width=300&thumbnail_height=300&resize_type=ResizeFitAllFill" width="200" alt="WVS Logo">
    </a> with
    <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo">
    </a>
</div>

<div align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-indigo?style=for-the-badge" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-5.7-orange?style=for-the-badge" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge" alt="Laravel"/>
  <img src="https://img.shields.io/badge/Composer-2.7-blue?style=for-the-badge" alt="Composer"/>
  <img src="https://img.shields.io/badge/npm-10.5-green?style=for-the-badge" alt="Laravel"/>
</div>

## プロジェクト概要

このプロジェクトは、Warwick Vocaloid Society（ウォーリック大学 ボーカロイド部）、通称WVSの公式ウェブサイトを開発するためのものです。

このサイトには大きく２形態あります。

１つ目は、メインWEBです。メンバーと非メンバーの両方に向けた静的なウェブサイト（一部は動的）で、ここではWVSの概要、イベント情報、ショーケース、連絡先情報、などの情報を発信します。

２つ目は、WVSプラットフォームです。メンバー向けの動的プラットフォームで、ここでは機材の貸し出し、ジュークボックス、ショーケースへの作品提出などのユーザーが実際に触って動かせる機能を実装しています。

この２つを行き来するには、最初に案内される静的なウェブサイトから新規登録することで動的プラットフォームに移動できます。その後、サインインしている状態ならnavbarから自由に行き来できます。

## 主な機能

- セキュアを意識した、ユーザー登録および認証
    - Google Authenticator 2FAに対応しています。初期設定は、メール認証後、本WEBに生成されたQRコードをお使いのスマートフォンのGoogle Authenticatorアプリから読み込むことでワンタイムパスを受け取れるようになります。
    - プロフィール画面から無効化も可能です。
- 機材貸し出しサービス
    - メンバーが機材の個数・借りる日数を入力し、カートに追加した後、注文を確定することで借りれます。返却日の確認は「ダッシュボード」から行えます。検索、カテゴリごと、お気に入りの３つの手段で商品の絞り込みも可能です。
    - アドミンがカタログに機材の追加・編集・削除や、「貸し出しログ」から注文の編集・キャンセルを行えます。
- ジュークボックス
    - メンバーがYouTubeから好きな曲を送信します。
    - アドミンが対面のイベントなどでみんなが投稿した曲の「セットリスト」から再生・停止、さらにスキップ・削除できます。
- ショーケース
    - メンバーが自身の作品をショーケースに投稿するため提出します。
    - アドミンがそれを「ショーケース候補」から採用または却下し、採用したものはメインWEBの「ショーケース」に載ります。また、アドミンはWVSプラットフォームの「ショーケース情報」から編集・削除が可能です。
- お問い合わせフォーム
    - メンバーが利用規約に同意するすることで問い合わせできます。
    - アドミンがそれを確認できます。必要に応じて、編集・削除も可能です。
- ユーザー情報
    - アドミンが一般ユーザー（メンバー）の情報を一覧できます。
    - さらに、ユーザーの削除や、ユーザーの名前、メール、ウォーリックID、権限などの編集が可能です。
- 多言語対応（日本語と英語）
    - メインWEBとWVSプラットフォームの両方で、navbarから言語の切り替えが可能です。
- ダークモード
    - WVSプラットフォームでライトモードとダークモードの切り替えが可能です。
- プロフィール情報
    - 全てのユーザーはWVSプラットフォームのプロフィールから自身の情報、プロフィール画像、２段階認証の有効化・無効化を設定できます。
- レスポンシブデザイン
    - 基本的に全てのページがレスポンシブ対応しています。

## 環境設定

以下の手順に従って、プロジェクトをローカル環境に設定します。

### 必要要件

- PHP >= 8.2.17
- MySQL >= 5.7.39
- Laravel = 11.x
- Composer >= 2.7.2
- npm >= 10.5.0

上記のバージョンが全て一致している環境で動作確認済みです。

### インストール手順

1. リポジトリをクローンします。

   ```bash
   git clone https://github.com/Tatsunori-Ono/laravel-wvs.git
   cd laravel-wvs
   ```
2. 依存パッケージをインストールします。

   ```bash
   composer install
   npm install
   npm run dev
   ```
3. `.env`ファイルを作成し、必要な環境変数を設定します。

   ```bash
   cp .env.example .env
   ```

   必要な環境変数を設定します。

   ```env
   APP_NAME=WVS
   APP_ENV=local
   #APP_KEYは次のステップ(4)で生成します
   APP_KEY=
   # 開発者向け: Laravel Debugbarの表示(true)・非表示(false)です
   APP_DEBUG=false
   APP_TIMEZONE=UTC
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   #以下の3項目を記入してください
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   #以下の2項目を記入してください
   MAIL_USERNAME=your_email@gmail.com
   # Gmailのアプリパスワードはこのリンクから直接生成できます: https://myaccount.google.com/apppasswords
   MAIL_PASSWORD=your_email_password
   MAIL_ENCRYPTION=tls
   #以下の項目を記入してください
   MAIL_FROM_ADDRESS="your_email@gmail.com"
   MAIL_FROM_NAME="Warwick Vocaloid Society"
   ```
4. アプリケーションキーを生成します。

   ```bash
   php artisan key:generate
   ```
5. データベースをマイグレートすると共に、開発用のサンプルデータをシーディングします。

   ```bash
   php artisan migrate:fresh --seed
   ```
6. ストレージのシンボリックリンクを作成
    ```bash
   php artisan storage:link
   ```
7. ローカルサーバーを起動します。

   ```bash
   php artisan serve
   ```
8. ブラウザで`http://127.0.0.1:8000/about`にアクセスして本WEBサイトを使用できます！日本語設定にするにはnavbarの「JA」を選択してください。

## 開発者向け情報

### ログイン情報

- アドミン（管理者）アカウント
  - メール: `tatsunorionoastroid@gmail.com`
  - パスワード: `admin`
- 一般ユーザー（メンバー）アカウント
  - メール: `tatsunori.no1@gmail.com`
  - パスワード: `user`

上記のアカウントはメール認証済みの体でシード生成しているため、新規登録の手順をスキップしています。
もしメール認証の機能をテストしたい場合は、新規登録からご自身のメールで検証して頂けると嬉しいです。

## ディレクトリ構造

- `app`：主要なコントローラーやモデル
- `config`：アプリケーションの設定ファイル
- `database`：データベースのマイグレーションとシードファイル
- `lang`：言語設定ファイル
- `public`：公開アクセス用のファイル（ロゴやシードの画像など）
- `resources`：ビューファイル、未コンパイルのアセット
- `routes`：ルート定義

## メンテナンス

メンテナンスモードを有効にするには、以下のコマンドを実行します。

```bash
php artisan down
```

メンテナンスモードを解除するには、以下のコマンドを実行します。

```bash
php artisan up
```

---

Warwick Vocaloid SocietyのWEBサイトをご覧頂き、ありがとうございます！今後とも応援のほど、どうぞよろしくお願い申し上げます。ご質問やフィードバックがございましたら、お気軽にtatsunorionoastroid@gmail.comお問い合わせください。
