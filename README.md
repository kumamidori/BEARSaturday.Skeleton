BEARSaturday/Skeleton
=====================

### イントロダクション

BEAR.Saturdayのアプリケーションスケルトンのインストールとphpunit等のQAツールのセットアップを行います。

    /path/to/your/project
        |
        +--- App/
        +--- bin/
        +--- data/
        +--- htdocs/
        +--- logs/
        +--- tests/
        |       |
        |       +--- bootstrap.php
        +--- tmp/
        +--- vendor/
        |       |
        |       +--- この下にBEAR/PEARが入ります
        |
        +--- App.php
        +--- composer.json
        +--- phpunit.xml.dist

### 概要

- [composer](http://getcomposer.org/])のインストール
- composerのcreate-projectコマンド`composer create-project [プロジェクト名]` でBEAR.Saturdayのアプリケーションスケルトンを作成
- phpunit等のQAツールをグローバルのcomposer環境にインストール


インストール / セットアップ
----------------------------

#### 1. composerのダウンロード

[`composer.phar`](https://getcomposer.org/composer.phar) をダウンロードします。

```bash
$ curl -sS https://getcomposer.org/installer | php
```
curl コマンドが無ければ以下でも同じことができます。

```bash
$ php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
```

#### 2. アプリケーションスケルトンの作成

```bash
$ php composer.phar create-project bearsaturday/skeleton [プロジェクトディレクトリ]
```

[プロジェクトディレクトリ]が作成されている事を確認します。

#### 3. QAツールのインストール

PHPUnitをcomposerのグローバル環境にインストールします。

```bash
$ php composer.phar global require 'h4cc/phpqatools=*' 'phpunit/phpunit-selenium:*' 'phpunit/phpunit-story:*'
```
ホーム下の.composerディレクトリ(~/.composer/)にインストールされます。

#### 4. パスの設定
　
上記でインストールしたphpunit等のQAツールにパスを通します。(左から評価されてマッチしたパスが使われるので優先したいパスを左側に配置する必要があります)

~/.zshrc / ~/.bash_profile

```bash
export PATH=~/.composer/vendor/phpunit/phpunit/composer/bin:$PATH
```

反映して確認します。

```bash
$ source ~/.zshrc
$ which phpunit

~/.composer/vendor/phpunit/phpunit/composer/bin/phpunit
```

#### 5.テスト実行

```bash
$ phpunit
```
アプリケーションスケルトンのテストが実行されることを確認します。


余談：PHPUnitインストール手順と運用について
-------------------------------------------

参照：
http://phpunit.de/manual/current/ja/installation.html


メモ：
- PEARでシステムグローバル環境にPHPUnitをインストールする場合の制限
  - root相当権限が無いとインストールができない

- PEARでユーザ環境（homeやプロジェクト下）にインストールする場合の制限
  - デフォルト（標準）だと、コマンド（CLI）がシステムグローバルの include_path を見るため、起動できない
  - http://www.php.net/manual/ja/ini.core.php#ini.include-path
  -  include_path で環境変数 ${USER} を使う例 `include_path = ".:${USER}/pear/php"`

- Composer でローカル環境（プロジェクト下）にインストールする場合のデメリット
  - 本番環境とデバッグ環境で、依存管理を分けるための工夫が必要になる（本番環境にはphpunitが要らないので）

- Composer でシステムグローバル環境（デフォルトだと ~/.composer/下）にインストールする場合
  - 本番環境とデバッグ環境で、簡単に依存管理を分けることができる点がメリット
  - パスを通すのがめんどうな点がデメリットか
