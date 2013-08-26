BEAR-Saturday-Extension-Setup - Local Pear Installer
========================================


まだ作りかけです。


Summary
--------------------

下記のセットアップを行います。

    ```
    /path/to/your/project

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
    ```


1. cd /path/to/your/local/project
2. 上記1. のディレクトリに、composer をインストールします
3. 上記1. のディレクトリに、ファイル「composer.json」を新規作成して保存します
4. composer install を実行します
以上。


Installation / Usage
--------------------

1. cd /path/to/your/local/project

2. Download the [`composer.phar`](https://getcomposer.org/composer.phar) executable or use the installer.

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

4. Run Composer: `php composer.phar install`
