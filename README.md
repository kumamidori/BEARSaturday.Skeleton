BEAR-Saturday-Extension-Setup - Local Pear Installer
========================================

そのうちBEAR.SaturdayのOrganizationアカウントに移す予定。

概要
--------------------

下記のセットアップを行います。

    ```
    /path/to/your/project
        |
        +--- App
        +--- htdocs
        |
        +--- libs
              |
              +--- .pearrc ＜Here!
              |
              +--- pear
                    |
                    +--- php
                          |
                          +--- BEAR ＜Here!
        +--- tmp
        +--- logs
        +--- App.php
    ```

1. cd /path/to/your/local/project
2. 上記1. のディレクトリに、composer をインストールします
3. 上記1. のディレクトリに、ファイル「composer.json」を新規作成して保存します
4. composer install を実行することで、BEAR.Saturdayのスケルトン作成までを完了します。
5. phpunit 等をグローバルのComposer環境にインストールして、環境変数PATHでコマンドへのパスを通します。


インストール / 使い方
--------------------

1. cd /path/to/your/local/project

2. composerコマンドをまだインストールしていなければ、[`composer.phar`](https://getcomposer.org/composer.phar) をダウンロードして下さい。

    ```
    $ curl -sS https://getcomposer.org/installer | php
    ```

    ※curl コマンドが無ければ、以下でも同じことができます。

    ```
    $ php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
    ```

3. 下記内容でファイル名「composer.json」として保存します。 

    ``` json
    {
        "require": {
            "kumamidori/bear-saturday-extension-setup": "*"
        },
        "scripts": {
            "post-install-cmd": "Installer::postInstall"
        }
    }
    ```

4. Composerを実行: `php composer.phar install`

5. Composerを実行: `php composer.phar global require 'h4cc/phpqatools'`

6. 上記5. でインストールしたphpunitコマンドへのパスを通す。

    zsh の場合
    ```
    export PATH=~/.composer/vendor/phpunit/phpunit/composer/bin:$PATH
    ```
    ※優先したいパスを左側に書く（左から評価されてマッチしたパスが使われるので）


PHPUnitインストール手順と運用について
--------------------

http://phpunit.de/manual/current/ja/installation.html

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
