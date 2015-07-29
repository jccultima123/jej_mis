<?php

class View
{
    
    public static function detectUser() {
        Session::init();
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/admin.php';
            exit();
        } else if (isset($_SESSION['SOM_user_logged_in'])) {
            require VIEWS_PATH . '_users/som.php';
            exit();
        } else if (isset($_SESSION['ASSET_user_logged_in'])) {
            require VIEWS_PATH . '_users/ams.php';
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            require VIEWS_PATH . '_users/crm.php';
            exit();
        } else if (isset($_SESSION['user_logged_in'])) {
            require VIEWS_PATH . '_users/blocked.php';
            exit();
        } else {
            require VIEWS_PATH . '_users/default.php';
        }
    }
    
    public static function adminMode() {
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
    }
    
    public static function header($module) {
        if (isset($_SESSION['admin_logged_in'])) {
            return HEADER . 'admin.php';
        }
        if (isset($module)) {
            return HEADER . $module;
        } else {
            exit;
        }
    }
    
    public static function footer($module) {
        if (isset($_SESSION['admin_logged_in'])) {
            return FOOTER . 'admin.php';
        }
        if (isset($module)) {
            return FOOTER . $module . '.php';
        } else {
            exit;
        }
    }
    
    //customized footer from templates, etc.
    public static function footerCust($module) {
        if (isset($_SESSION['admin_logged_in'])) {
            return FOOTER . 'admin.php';
        }
        if (isset($module)) {
            return VIEWS_PATH . $module . '.php';
        } else {
            exit;
        }
    }

    public static function adminLogo() {
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/header/admin_logo.php';
        } else if (isset($_SESSION['SOM_user_logged_in'])) {
            require VIEWS_PATH . '_users/header/som_logo.php';
        } else if (isset($_SESSION['ASSET_user_logged_in'])) {
            require VIEWS_PATH . '_users/header/ams_logo.php';
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            require VIEWS_PATH . '_users/header/crm_logo.php';
        }
    }
    
    public static function logout() {
        if (!isset($_SESSION['admin_logged_in'])) {
            if (isset($_SESSION['SOM_user_logged_in'])) {
                require VIEWS_PATH . '_users/header/som_logout.php';
            } else if (isset($_SESSION['ASSET_user_logged_in'])) {
                require VIEWS_PATH . '_users/header/ams_logout.php';
            } else if (isset($_SESSION['CRM_user_logged_in'])) {
                require VIEWS_PATH . '_users/header/crm_logout.php';
            }
        } else if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/header/admin_logout.php';
        }
    }
    
}
