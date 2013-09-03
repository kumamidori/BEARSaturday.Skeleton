BEARSaturday/Skeleton
========================================

概要
--------------------

下記のセットアップを行います。

    ``` 
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
        |       +--- この下にBEARが入ります
        |
        +--- App.php
        +--- composer.json
        +--- phpunit.xml.dist
    ```

### だいたいの流れ
- プロジェクトのディレクトリに、composer をインストールする（まだなければ）
- composer で `create-project [プロジェクト名]` を実行することで、BEAR.Saturdayのスケルトン作成までが完了
- phpunit 等をグローバルのComposer環境にインストールする


インストール / 使い方
--------------------

1. `cd [プロジェクトの１つ上にあたるディレクトリ]`

2. composerコマンドをまだインストールしていなければ、[`composer.phar`](https://getcomposer.org/composer.phar) をダウンロードして下さい。

    ```
    $ curl -sS https://getcomposer.org/installer | php
    ```

    ※curl コマンドが無ければ、以下でも同じことができます。

    ```
    $ php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
    ```

3. Composerを実行: `php composer.phar create-project bearsaturday/skelton [プロジェクトディレクトリ]`

   普通にSaturdayがセットアップされた状態になったことを確認。

5. Composerを実行:

   `php composer.phar global require 'h4cc/phpqatools=*'`

   PHPUnitをComposerのシステムグローバル環境にインストール。
   （通常だと、ホームの下に入ります。~/.composer/ 下）。

6. 上記5. でインストールしたphpunitコマンドへ、パスを通す。

    zsh の場合


    vi ~/.zshrc
    ```
    export PATH=~/.composer/vendor/phpunit/phpunit/composer/bin:$PATH
    ```

    反映
    ```
    source ~/.zshrc
    ```

    確認
    ```
    which phpunit
    ```
    で、```~/.composer/vendor/phpunit/phpunit/composer/bin/phpunit```になること。

    ※優先したいパスを左側に書いて先に評価させる必要がある（左から評価されてマッチしたパスが使われるので）


    実行
    ```
    phpunit
    ```
    で、実行されたことを確認。


余談：PHPUnitインストール手順と運用について
--------------------

原典：
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
