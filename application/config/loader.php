<?php

// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
$lib = '../vendor' . '/autoload.php';
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

// load external libraries/classes. have a look all the files in that directory for details.
foreach (glob(APP . 'libs/*.php') as $files) { require $files; }

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';
