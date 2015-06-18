<?php

use Gregwar\Captcha\CaptchaBuilder;

class AmsModel
{

    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            $ERROR = $e . '<br /><br />';
            require_once '_fb/error.html';
            exit;
        }
    }

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        if (!isset($_SESSION['AMS_user_logged_in'])) {
            $_SESSION["feedback_positive"][] = FEEDBACK_INVALID_LOGOUT;
        } else {
            // delete the session
            Session::destroy();
            // init again for message
            Session::init();
            $_SESSION["feedback_positive"][] = FEEDBACK_LOGGED_OUT;
        }
    }
    
    /**
     * Checks if the entered captcha is the same like the one from the rendered image which has been saved in session
     * @return bool success of captcha check
     */
    private function checkCaptcha()
    {
        if (isset($_POST["captcha"]) AND ($_POST["captcha"] == $_SESSION['captcha'])) {
            return true;
        }
        // default return
        return false;
    }

}
