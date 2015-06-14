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

    public function login() {
        
        // ALGORITHM FROM PHP-LOGIN
        // we do negative-first checks here
        if (empty($_POST['user_name']) AND empty($_POST['user_password'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_AND_PASSWORD_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['user_name']) OR empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['user_password']) OR empty($_POST['user_password'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }

        $query = $this->db->prepare("SELECT * FROM tb_users WHERE (user_name = :user_name OR user_email = :user_name) AND user_provider_type = :provider_type");

        $query->execute(array(':user_name' => $_POST['user_name'], ':provider_type' => 'AMS'));
        $count = $query->rowCount();
        
        if ($count != 1) {
            $_SESSION["feedback_negative"][] = FEEDBACK_INCORRECT_LOGIN;
            return false;
        }
        
        // fetch one row (we only have one result)
        $result = $query->fetch();

        // check if hash of provided password matches the hash in the database
        if (sha1($_POST['user_password']) == $result->user_password) {

            if ($result->user_active != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET;
                return false;
            }
            /**if ($result->user_account_type = 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_INCORRECT_LOGIN;
                return false;
            }**/
            
                // login process, write the user data into session
                Session::init();
                Session::set('AMS_user_logged_in', true);
                Session::set('user_id', $result->user_id);
                Session::set('user_name', $result->user_name);
                Session::set('user_email', $result->user_email);
                Session::set('first_name', $result->first_name);
                Session::set('user_account_type', $result->user_account_type);
                Session::set('user_provider_type', 'AMS');

                // reset the failed login counter for that user (if necessary)
                if ($result->user_last_failed_login > 0) {
                    $sql = "UPDATE tb_users SET user_failed_logins = 0, user_last_failed_login = NULL
                            WHERE user_id = :user_id AND user_failed_logins != 0";
                    $sth = $this->db->prepare($sql);
                    $sth->execute(array(':user_id' => $result->user_id));
                }

                // generate integer-timestamp for saving of last-login date
                $user_last_login_timestamp = time();
                // write timestamp of this login into database (we only write "real" logins via login form into the
                // database, not the session-login on every page request
                $sql = "UPDATE tb_users SET user_last_login_timestamp = :user_last_login_timestamp WHERE user_id = :user_id";
                $sth = $this->db->prepare($sql);
                $sth->execute(array(':user_id' => $result->user_id, ':user_last_login_timestamp' => $user_last_login_timestamp));

                // return true to make clear the login was successful
                return true;

        } else {
            // increment the failed login counter for that user
            $sql = "UPDATE tb_users
                    SET user_failed_logins = user_failed_logins+1, user_last_failed_login = :user_last_failed_login
                    WHERE user_name = :user_name OR user_email = :user_name";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(':user_name' => $_POST['user_name'], ':user_last_failed_login' => time() ));
            // feedback message
            $_SESSION["feedback_negative"][] = FEEDBACK_INCORRECT_LOGIN;
            return false;
        }

        // default return
        return false;
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
    
    public function submitRequest()
    {
        // perform all necessary form checks
        if (!$this->checkCaptcha()) {
            $_SESSION["feedback_negative"][] = FEEDBACK_CAPTCHA_WRONG;
        } elseif (empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
        } elseif (empty($_POST['user_branch'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_BRANCH_FIELD_EMPTY;
        } elseif (empty($_POST['user_password_new']) OR empty($_POST['user_password_repeat'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_REPEAT_WRONG;
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_TOO_SHORT;
        } elseif (strlen($_POST['user_name']) > 64 OR strlen($_POST['user_name']) < 2) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN;
        } elseif (empty($_POST['user_email'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_FIELD_EMPTY;
        } elseif (strlen($_POST['user_email']) > 64) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_TOO_LONG;
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN;
        } elseif (!empty($_POST['user_name'])
            AND strlen($_POST['user_name']) <= 64
            AND strlen($_POST['user_name']) >= 2
            AND preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            AND !empty($_POST['user_email'])
            AND strlen($_POST['user_email']) <= 64
            AND filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            AND !empty($_POST['user_password_new'])
            AND !empty($_POST['user_password_repeat'])
            AND ($_POST['user_password_new'] === $_POST['user_password_repeat'])) {

            // clean the input
            $user_name = strip_tags($_POST['user_name']);
            $user_email = strip_tags($_POST['user_email']);

            // Using SHA1 now
            $user_password_hash = sha1($_POST['user_password_new']);

            // check if username already exists
            $query = $this->db->prepare("SELECT * FROM tb_users WHERE user_name = :user_name");
            $query->execute(array(':user_name' => $user_name));
            $count =  $query->rowCount();
            if ($count == 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_ALREADY_TAKEN;
                return false;
            }

            // check if email already exists
            $query = $this->db->prepare("SELECT user_id FROM tb_users WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));
            $count =  $query->rowCount();
            if ($count == 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USER_EMAIL_ALREADY_TAKEN;
                return false;
            }

            // generate random hash for email verification (40 char string)
            $user_activation_hash = sha1(uniqid(mt_rand(), true));
            // generate integer-timestamp for saving of account-creating date
            $user_creation_timestamp = time();

            // write new users data into database
            $sql = "INSERT INTO tb_users (user_name, user_password, user_email, first_name, last_name, middle_name, user_branch, user_creation_timestamp, user_activation_hash, user_provider_type)
                    VALUES (:user_name, :user_password, :user_email, :first_name, :last_name, :middle_name, :user_branch, :user_creation_timestamp, :user_activation_hash, :user_provider_type)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_name' => $user_name,
                                  ':user_password' => $user_password_hash,
                                  ':user_email' => $user_email,
                                  ':first_name' => strtoupper($_POST['first_name']),
                                  ':last_name' => strtoupper($_POST['last_name']),
                                  ':middle_name' => strtoupper($_POST['middle_name']),
                                  ':user_branch' => $_POST['user_branch'],
                                  ':user_creation_timestamp' => $user_creation_timestamp,
                                  ':user_activation_hash' => $user_activation_hash,
                                  ':user_provider_type' => 'AMS'));
            $count =  $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_CREATION_FAILED;
                return false;
            }

            // get user_id of the user that has been created, to keep things clean we DON'T use lastInsertId() here
            $query = $this->db->prepare("SELECT user_id FROM tb_users WHERE user_name = :user_name");
            $query->execute(array(':user_name' => $user_name));
            if ($query->rowCount() != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
                return false;
            }
            $result_user_row = $query->fetch();
            $user_id = $result_user_row->user_id;

            // send verification email, if verification email sending failed: sends to administrator instead
            
            if (Email::sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
                $_SESSION["feedback_positive"][] = FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED;
                return true;
            } else {
                $_SESSION["feedback_positive"][] = FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED_NOEMAIL;
                return true;
            }
            
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
        }
        // default return, returns only true of really successful (see above)
        return false;
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
