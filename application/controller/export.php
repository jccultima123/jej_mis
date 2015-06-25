<?php

/*
 * JEJ_MIS PRINT API
 * This will let the system export-to-print whatever output is
 * occured in the "print" page.
 */

class Export extends Controller {

    function __construct() {
        parent::__construct();
        //using DOMPDF API (Sources are in /vendor directory)
    }

    function exportAction() {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action = 'print') {
                $dompdf->load_html(APP . 'view/admin/header.php');
                $dompdf->render();
                $dompdf->stream("HELLO" . ".pdf");
            }
        }
    }

}
