<?php

class View
{
    // PAGED LIST
    public static function getPagedList($module)
    // Needed when you have a list/table
    {
        if (!isset($_GET['page'])) {
            header('location: ' . URL . $module . '?page=1');
        }
    }
    
    public static function getPagedListSOM($module)
    // Needed when you have a list/table
    {
        if (!isset($_GET['page'])) {
            header('location: ' . URL . 'som/' . $module . '?page=1');
        }
    }
    
    /* Improved Render function (DISABLED)
     * Concept by panique / (c) Corsanes (jccultima123)
     * TODO: Not should be a static since it's not / $this issues
     */
    public function render($module, $sub, $profile)
    {
        if (!isset($sub)) {
            //default index
            $sub = 'index';
        }
        if (!isset($profile)) {
            //default profile
            $profile = 'default';
        }
        /* $profile
         * default -- simple render with default header and footer of your module
         * custom -- render with less limits, but more potential conflicts unless you know what you're doing
         * static -- static. right? no javascript, everything but static html
         */
        switch ($profile) {
            case 'default':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'header.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'footer.php';
                break;
            case 'custom':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                break;
            case 'static':
                require VIEWS_PATH . TEMPLATE . 'static_header.php';
                $this->adminMode();
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . TEMPLATE . 'static_footer.php';
                break;
            default:
                $ERROR = "There's something wrong in rendering views.";
                require_once "_fb/error.html";
                exit();
        }
    }
    
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
