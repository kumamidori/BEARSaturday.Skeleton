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
 * Hello World 2
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
class Page_Test_HelloWorld2 extends App_Page
{
    /**
     * Inject
     */
    public function onInject()
    {
        parent::onInject();
        $this->injectGet('id', 'id', 0);
    }

    /**
     * Init
     *
     * @param array $args
     */
    public function onInit(array $args)
    {
        $params = [
            'uri' => 'Test/User',
            'values' => ['id' => $args['id']],
            'options' => ['template' => 'test/greeting']
        ];
        $this->_resource->read($params)->set('greeting');
    }

    /**
     * Output
     */
    public function onOutput()
    {
        $this->display('helloWorld.tpl');
    }
}

App_Main::run('Page_Test_HelloWorld2', [], ['injector' => 'onInjectUA']);
