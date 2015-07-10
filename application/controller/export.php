<?php

/*
 * JEJ_MIS PRINT API
 * This will let the system export-to-print whatever output is
 * occured in the "print" page.
 */

class Export extends Controller {

    function __construct() {
        parent::__construct();
        Auth::loginCheck();
    }

    function exportAction($module) {
        if (isset($module)) {
            
        }
    }

}
