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
        $io = $event->getIO();
        $libsPath = $fullPath . '/' . 'libs';
        if(file_exists($libsPath . '/.pearrc') || file_exists($fullPath . '/App.php')) {
            $io->write("<error>** Error: path {$libsPath}/.pearrc already exists. **</error>");

            return;
        }
        chdir($libsPath);
        mkdir($libsPath);

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

        $io->write('<info>***** Installing...</info>');
        foreach($commands as $cmd) {
            $io->write('<info>** ' . $cmd . ' **</info>');
            system($cmd, $retval);
        }
        $io->write('<info>***** Installation Complete.</info>');

        $io->write('<info>***** Init Application...</info>');
        $commands = array();
        $commands[] = "cp {$fullPath}/composer.json {$fullPath}/composer.json.bkup";
        $commands[] = "{$libsPath}/pear/bear init-app --pearrc {$libsPath}/.pearrc {$fullPath}";
        $commands[] = "rm -Rf {$fullPath}/composer.json";
        $commands[] = "rm -Rf {$fullPath}/composer.lock";
        $commands[] = "mv {$fullPath}/composer.json.bkup {$fullPath}/composer.json";

        foreach($commands as $cmd) {
            $io->write('<info>** ' . $cmd . ' **</info>');
            system($cmd, $retval);
        }
        $io->write('<info>***** Init Application Complete...</info>');
    }
}
