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
        } else if (isset($_SESSION['MIS_user_logged_in'])) {
            require APP . 'view/_users/mis.php';
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
    
    public static function adminMode() {
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/_templates/admin_mode.php';
        }
    }
    
    public static function logout() {
        if (!isset($_SESSION['admin_logged_in'])) {
            if (isset($_SESSION['MIS_user_logged_in'])) {
                require APP . 'view/_users/header/mis_logout.php';
            } else if (isset($_SESSION['CRM_user_logged_in'])) {
                require APP . 'view/_users/header/crm_logout.php';
            }
        }
    }

}
