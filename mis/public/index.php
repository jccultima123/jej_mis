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
 */

//turn on output buffering
ob_start();
// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// This will load all libraries and configurations required for this app.
require APP . 'config/loader.php';

/**
 * This will start the application
 */
$app = new Application();
