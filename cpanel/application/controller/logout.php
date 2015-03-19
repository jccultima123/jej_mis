<?php

/**
 * Logout Controller
 */

class Logout extends Controller
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/logout/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
    
?>

