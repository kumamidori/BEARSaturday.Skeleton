<?php
/**
 * Live App for fastest boot
 *
 */
require_once 'BEAR.php';

define('_BEAR_APP_HOME', realpath(dirname(dirname(__FILE__))));
BEAR::init(BEAR::loadConfig(_BEAR_APP_HOME . '/App/app.yml', true));
