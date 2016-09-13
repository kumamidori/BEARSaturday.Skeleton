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

/**
 * Main
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
class App_Main extends BEAR_Main
{
    /**
     * Inject
     */
    public function onInject()
    {
        parent::onInject();
    }

    /**
     * Inject multi UA
     */
    public function onInjectUA()
    {
        // UA Sniffing
        BEAR_Main_Ua_Injector::inject($this, $this->_config);
        parent::onInject();
    }
}
