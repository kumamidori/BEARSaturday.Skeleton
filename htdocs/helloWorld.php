<?php
/**
 * App
 *
 * @category   BEAR
 *
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 *
 * @version    Release: @package_version@ $Id:$
 *
 * @link       http://@link_url@
 */
require_once 'App.php';

/**
 * Hello World
 *
 * @category   BEAR
 *
 * @author     $Author:$ <username@example.com>
 * @license    @license@ http://@license_url@
 *
 * @version    Release: @package_version@ $Id:$
 *
 * @link       http://@link_url@
 */
class Page_HelloWorld extends App_Page
{
    /**
     * Inject
     */
    public function onInject()
    {
    }

    /**
     * Init
     *
     * @param array $args
     */
    public function onInit(array $args)
    {
        $this->set('greeting', 'hello world');
    }

    /**
     * Output
     */
    public function onOutput()
    {
        $this->display('helloWorld.tpl');
    }
}

App_Main::run('Page_HelloWorld');
