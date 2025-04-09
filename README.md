# 技能五輪全国大会2020年ウェブデザイン職種 スピードテスト回答例

このリポジトリは技能五輪全国大会2020年ウェブデザイン職種のスピードテストの回答例をまとめたものです。

phpMyAdminが導入済みのため、ブラウザからデータベースを確認することが出来ます。

## 必須環境

- Docker (Docker Desktop, Docker Engine)
- Hyper-V (Windowsのみ)
- WSL2 (Windowsのみ)

※Hyper-VとWSL2はどちらか一方がセットアップされている必要があります。

## セットアップ手順

1. `git clone https://github.com/saitogo555/gorin2020-webdesign-speedtest.git`を実行してリポジトリをクローンする
2. `cd gorin2020-webdesign-speedtest`を実行してプロジェクトフォルダに移動する。
3. `docker compose up -d`を実行してコンテナを起動する。

## サービス一覧

| サービス名                 | 概要                                |
|---------------------------|-------------------------------------|
| [php](#php)               | Apache                    |
| [mariadb](#mariadb)       | リレーショナルデータベース            |
| [phpmyadmin](#phpmyadmin) | ブラウザベースのデータベース管理ツール |

## php

srcフォルダ直下がドキュメントルートになります。

`http://localhost:8080`でWebサイトにアクセスできます。

### データベース

| Key        | Value       |
|------------|-------------|
| HOST       | mariadb     |
| PORT       | 3306        |
| DATABASE   | compe2020   |
| USERNAME   | web         |
| PASSWORD   | 0202nesoy   |

## mariadb

phpMyAdminからデータベースの管理を行うことが出来ます。

直接コマンドでデータベースを操作する場合は下記の手順でMariaDBにログイン出来ます。

1. `docker compose exec mariadb bash`を実行してmariadbコンテナに入る。
2. `mariadb -u root -p`を実行してパスワード入力画面に遷移する。
3. パスワード`root`を入力し、Enterを押してMariaDBにログインする。

## phpmyadmin

`http://localhost:8081`でデータベースの管理画面にアクセス出来ます。
