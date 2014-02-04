<?php

namespace BEAR\Install;

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
        $event->getIo()->write('<info>Thank you for using BEAR.Saturday.</info>');
    }

    private static function setUp(Event $event)
    {
        $dir = dirname(__DIR__);
        $commands = array(
            "chmod -R 777 {$dir}/logs/",
            "chmod -R 777 {$dir}/tmp/",
        );
        foreach($commands as $cmd) {
            $event->getIo()->write('<info>' . $cmd . '</info>');
            passthru($cmd, $retval);
        }
        if (! file_exists("{$dir}/htdocs/htaccess.txt")) {
            return;
        }
        $htaccess = "{$dir}/htdocs/.htaccess";
        rename("{$dir}/htdocs/htaccess.txt", $htaccess);
        $contents = file_get_contents($htaccess);
        $contents = str_replace('@APP-DIR@', "{$dir}", $contents);
        file_put_contents($htaccess, $contents);
    }
}
