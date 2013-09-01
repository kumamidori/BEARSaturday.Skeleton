BEAR-Saturday-Extension-Setup - Local Pear Installer
========================================

Beta version.

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

5. Composerを実行: `composer global require 'h4cc/phpqatools'`

6. 上記5. でインストールしたphpunitコマンドへのパスを通す。

    zsh の場合
    ```
    export PATH=~/.composer/vendor/phpunit/phpunit/composer/bin:$PATH
    ```
    ※優先したいパスを左側に書く（左から評価されてマッチしたパスが使われるので）
