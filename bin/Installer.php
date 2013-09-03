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
        self::setup($event);
    }

    private static function setUp(Event $event)
    {
        $dir = dirname(__DIR__);
        $commands = array(
            "chmod -R 777 {$dir}/logs/",
            "chmod -R 777 {$dir}/tmp/",
            "chmod -R 777 {$dir}/tmp/",
            "mv {$dir}/htdocs/htaccess.txt {$dir}/htdocs/.htaccess"
        );
        foreach($commands as $cmd) {
            $event->getIo()->write('<info>' . $cmd . '</info>');
            passthru($cmd, $retval);
        }

        $htaccess = "{$dir}/htdocs/.htaccess";
        $contents = file_get_contents($htaccess);
        $contents = str_replace('@APP-DIR@', "{$dir}", $contents);
        file_put_contents($htaccess, $contents);
    }
}
