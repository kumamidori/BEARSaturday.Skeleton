<?php
/**
 */
use Composer\Script\Event;

/**
 */
class Installer
{
    public static function postInstall(Event $event = null)
    {
        $projectRoot = dirname(dirname(dirname(dirname(__DIR__))));
        self::pearLocalSetup($event, $projectRoot);
    }

    public static function pearLocalSetup(Event $event, $fullPath)
    {
        $libsPath = $fullPath . '/' . 'libs';
        if(file_exists($libsPath . '/.pearrc')) {
            echo "Error: path {$libsPath}/.pearrc already exists." . PHP_EOL;
            return;
        }
        mkdir($libsPath);
        chdir($libsPath);

        $commands = array();
        $commands[] = "pear config-create {$libsPath} .pearrc";
        $commands[] = "pear -c {$libsPath}/.pearrc config-set auto_discover 1";
        $commands[] = "pear -c {$libsPath}/.pearrc config-set preferred_state alpha";
        $commands[] = "pear -c {$libsPath}/.pearrc channel-update pear.php.net";
        $commands[] = "pear -c {$libsPath}/.pearrc install PEAR";
        // 古いpear環境で下記のようなエラーになる場合、
        // グローバル更新する権限がユーザに無いと upgrade ができないので、以降は libs/ 下のpearコマンドを使う。
        // （pear/HTTP_Request2 requires PEAR Installer (version >= 1.9.2), installed version is 1.9.1）
        $commands[] = "{$libsPath}/pear/pear -c {$libsPath}/.pearrc channel-discover pear.bear-project.net";
        // -a は不要
        $commands[] = "{$libsPath}/pear/pear -c {$libsPath}/.pearrc install bear/BEAR-beta";

        $io = $event->getIO();
        $io->write('<info>***** Installing...</info>');
        foreach($commands as $cmd) {
            $io->write('<info>** ' . $cmd . ' **</info>');
            system($cmd, $retval);
        }
        $io->write('<info>***** Installation Complete.</info>');

        $io->write('<info>***** Init Application...</info>');
        $cmd = "{$libsPath}/pear/bear -c {$libsPath}/.pearrc init-app {$fullPath}";
        system($cmd, $retval);
        $io->write('<info>***** Application Ok...</info>');
    }
}
