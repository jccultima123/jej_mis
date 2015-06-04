<?php

/**
 * jejMIS - Management Information System
 * Modified from Legacy Versions of PHP-LOGIN and MINI by panique
 *
 * @package jejMIS
 * @author jccultima
 * @link https://github.com/jccultima123/jej_mis/
 * 
 */

/**
 * THIS IS THE STARTING POINT OR ROOT OF THE MVC FRAMEWORK
 * This will load all libraries and configurations required for this app.
 */

//turn on output buffering
ob_start();

// TODO get rid of this and work with namespaces + composer's autoloader

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
$lib = '../vendor' . '/autoload.php';
if (file_exists($lib)) {
    require $lib;
    $phpexcel = new PHPExcel();
    $browser = new Browser();
} else {
    $ERROR = "The COMPOSER file " . $lib . " might be corrupted or missing.";
    require_once '_fb/error.html';
    exit;
}

// load application config (error reporting etc.)
require APP . 'config/config.php';

// load external libraries/classes. have a look all the files in that directory for details.
foreach (glob(APP . 'libs/*.php') as $files) { require $files; }
$rainCaptcha = new \RainCaptcha();

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';

/**
 * This will start the application
 */
$app = new Application();
