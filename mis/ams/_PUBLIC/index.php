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
define('APP', ROOT . '_APP' . DIRECTORY_SEPARATOR);

// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
$lib = APP . '_composer/vendor' . '/autoload.php';
if (file_exists($lib)) {
    require $lib;
    //$phpexcel = new PHPExcel();
    $browser = new Browser();
} else {
    $ERROR = "The COMPOSER file " . $lib . " might be corrupted or missing.";
    require_once '_fb/error.html';
    exit;
}

// load application config (error reporting etc.)
require APP . 'config/config.php';

// FOR DEVELOPMENT: this loads PDO-debug, a simple function that shows the SQL query (when using PDO).
// If you want to load pdoDebug via Composer, then have a look here: https://github.com/panique/pdo-debug
require APP . 'libs/helper.php';

// other libs pulled from PHP-LOGIN
require APP . 'libs/Auth.php';
require APP . 'libs/Session.php';
// 3rd parties
require APP . 'libs/RainCaptcha.php';
$rainCaptcha = new \RainCaptcha();
//require APP . '/libs/password_compatibility_library.php';
//require APP . 'libs/prince.php';
//$prince = new Prince();

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';

/**
 * This will start the application
 */
$app = new Application();
