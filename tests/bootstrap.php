<?php
// for test
$_SERVER['bearmode'] = 100;

ini_set('display_errors', '1');
ini_set('error_reporting', '22519');
ini_set('log_errors', '1');
ini_set('ignore_repeated_errors', '1');
ini_set('html_errors', '0');
ini_set('track_errors', '1');
// mbstring
ini_set('mbstring.language', 'Japanese');
ini_set('mbstring.http_input', 'none');
ini_set('mbstring.http_output', 'none');
ini_set('mbstring.input_encoding', 'pass');
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('mbstring.script_encoding', 'UTF-8');
ini_set('mbstring.substitute_character', 'none');
ini_set('mbstring.encoding_translation', '0');
// output
ini_set('magic_quotes_gpc', '0');
ini_set('output_buffering', '1');
ini_set('output_handler', 'none');
ini_set('default_charset', 'none');
//time zone
ini_set('date.timezone', 'Asia/Tokyo');

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
/** @var $loader \Composer\Autoload\ClassLoader */
$loader->add('', __DIR__);
$loader->register();

$appPath = realpath(__DIR__ . '/..');
require_once $appPath . '/App.php';

// extension Xdebug
//$filter = PHP_CodeCoverage_Filter::getInstance();
//$filter->removeDirectoryFromWhitelist($appPath . 'App/views');
ob_start();
