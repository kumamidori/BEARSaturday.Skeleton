<?php
// for test
$_SERVER['bearmode'] = 100;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
/** @var $loader \Composer\Autoload\ClassLoader */
$loader->add('', __DIR__);
$loader->register();

$appPath = realpath(__DIR__ . '/..');
require_once $appPath . '/App.php';

// extension Xdebug
//$filter = PHP_CodeCoverage_Filter::getInstance();
//$filter->removeDirectoryFromWhitelist($appPath . 'App/views');
