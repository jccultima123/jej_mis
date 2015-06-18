<?php

class View
{
    public static function PagedList()
    {
        
    }
    
    public static function AuthUser()
    {
        
    }
    
    public static function detectUser() {
        Session::init();
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/_users/admin.php';
            exit();
        } else if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['rememberme'])) {
            require APP . 'view/_users/admin.php';
            exit();
        } else if (isset($_SESSION['SOM_user_logged_in'])) {
            require APP . 'view/_users/som.php';
            exit();
        } else if (isset($_SESSION['AMS_user_logged_in'])) {
            require APP . 'view/_users/ams.php';
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            require APP . 'view/_users/crm.php';
            exit();
        } else if (isset($_SESSION['user_logged_in'])) {
            require APP . 'view/_users/blocked.php';
            exit();
        } else {
            require APP . 'view/_users/default.php';
        }
    }

}
