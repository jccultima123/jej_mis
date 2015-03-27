<?php

/**
 * the auto-loading function, which will be called every time a file "is missing"
 * NOTE: don't get confused, this is not "__autoload", the now deprecated function
 * The PHP Framework Interoperability Group (@see https://github.com/php-fig/fig-standards) recommends using a
 * standardized auto-loader https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md, so we do:
 */
function autoload($class) {
    // if file does not exist in LIBS_PATH folder [set it in config/config.php]
    if (file_exists(APP . "/libs/" . $class . ".php")) {
        require APP . "/libs/" . $class . ".php";
    } else {
        exit ('CRITICAL ERROR<br />The file ' . $class . '.php is missing in the libs folder.');
    }
    
    //OTHERS
    if (file_exists(APP . "/model/" . $class . ".php")) {
        require APP . "/model/" . $class . ".php";
    } else {
        exit ('CRITICAL ERROR<br />The file ' . $class . '.php is missing in the model folder.');
    }
    
    if (file_exists(APP . "/view/" . $class . ".php")) {
        require APP . "/view/" . $class . ".php";
    } else {
        exit ('CRITICAL ERROR<br />The file ' . $class . '.php is missing in the view folder.');
    }
    
    if (file_exists(APP . "/controller/" . $class . ".php")) {
        require APP . "/controller/" . $class . ".php";
    } else {
        exit ('CRITICAL ERROR<br />The file ' . $class . '.php is missing in the controller folder.');
    }
}

// spl_autoload_register defines the function that is called every time a file is missing. as we created this
// function above, every time a file is needed, autoload(THENEEDEDCLASS) is called
spl_autoload_register("autoload");
