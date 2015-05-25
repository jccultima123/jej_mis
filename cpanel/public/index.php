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
if (file_exists('../vendor/autoload.php')) {
    require '../vendor/autoload.php';
    $phpexcel = new PHPExcel();
    $browser = new Browser();
} else {
    require_once '_fb/missing.html';
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
//DISABLED FOR NOW FOR SPEED
//require APP . '/libs/password_compatibility_library.php';

// 3rd-party libs
/**
require APP . 'libs/prince.php';
$prince = new Prince();
**/

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';

/**
 * This will start the application
 */
$app = new Application();
