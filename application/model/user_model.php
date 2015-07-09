<?php

/**
 * Account Model
 *
 * Handles the user's configurations
 */
use Gregwar\Captcha\CaptchaBuilder;

class UserModel
{

    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            Auth::detectEnvironment();
            $ERROR = "The database was either unable to connect or doesn't exists.<hr /><b>DEBUG:</b> " . $e . "<hr />";
            require_once '_fb/error.html';
            exit();
        }
    }
    
    public function getAllUsers()
    {
        $sql = "SELECT * FROM tb_users NATURAL JOIN tb_branch WHERE user_id != 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_USERS;
            return false;
        }
        return $fetch;
    }
    
    public function getAmountOfPendUsers($i)
    {
        $sql = "SELECT COUNT(user_id) AS pending_users FROM tb_users WHERE user_active = 0 AND user_activation_hash IS NOT NULL";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        $i = $query->fetch()->pending_users;
        return $i;
    }
        public function countPendUsers()
        {
            $sql = "SELECT COUNT(user_id) AS pending_users FROM tb_users WHERE user_active = 0 AND user_activation_hash IS NOT NULL";
            $query = $this->db->prepare($sql);
            $query->execute();

            // fetch() is the PDO method that get exactly one result
            return $query->fetch()->pending_users;
        }
    
    public function countUsers()
    {
        $sql = "SELECT COUNT(user_id) AS user_count FROM tb_users WHERE user_id != 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->user_count;
    }
    
    public function getUser($user_id)
    {
        $sql = "SELECT * FROM tb_users NATURAL JOIN tb_branch WHERE user_id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    public function getUsertype()
    {
        $sql = "SELECT * FROM tb_usertype";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    // IN ORDER TO AVOID DATA MESS
    public function checkUsers()
    {
        $query = $this->db->prepare("SELECT user_id, user_creation_timestamp FROM tb_users");
        $query->execute();
        // get result row (as an object)
        $result_user_row = $query->fetch();
        $countdown = time() - 3600;
        // 3600 seconds are 1 hour
        if ($result_user_row->user_creation_timestamp > $countdown) {
            // OKAY :D
            return false;
        } else {
            $sth = $this->db->prepare("DELETE FROM tb_users
                                       WHERE user_active = 0 AND user_activation_hash IS NULL");
            $sth->execute();
            $count = $sth->rowCount();
            if ($count == 1) {
                $_SESSION["feedback_positive"][] = FEEDBACK_USER_CLEANED;
                return true;
            }
        }
    }
    
    public function updateUser()
    {
        // perform all necessary form checks
        if (empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
        } elseif (strlen($_POST['user_name']) > 64 OR strlen($_POST['user_name']) < 6) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG;
        } elseif (!preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN;
        } elseif (empty($_POST['user_email'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_FIELD_EMPTY;
        } elseif (strlen($_POST['user_email']) > 64) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_TOO_LONG;
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN;
        } elseif (!empty($_POST['user_name'])
            AND strlen($_POST['user_name']) <= 64
            AND strlen($_POST['user_name']) >= 6
            AND preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            AND !empty($_POST['user_email'])
            AND strlen($_POST['user_email']) <= 64
            AND filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            // clean the input
            $user_name = substr(strip_tags($_POST['user_name']), 0, 64);
            $user_email = strip_tags($_POST['user_email']);
            // write new users data into database
            $sql = "UPDATE tb_users
                    SET user_name = :user_name,
                        branch_id = :branch_id,
                        user_email = :user_email,
                        first_name = :first_name,
                        last_name = :last_name,
                        middle_name = :middle_name,
                        user_provider_type = :user_provider_type
                    WHERE user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_name' => $user_name,
                                  ':branch_id' => $_POST['branch_id'],
                                  ':user_email' => $user_email,
                                  ':first_name' => strtoupper($_POST['first_name']),
                                  ':last_name' => strtoupper($_POST['last_name']),
                                  ':middle_name' => strtoupper($_POST['middle_name']),
                                  ':user_provider_type' => $_POST['user_provider_type'],
                                  ':user_id' => $_POST['user_id']));
            if ($query->rowCount() != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USER_ACTION_FAILED;
                return false;
            } else {
                $_SESSION["feedback_positive"][] = CRUD_UPDATED;
                return true;
            }
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
        }
        // default return, returns only true of really successful (see above)
        return false;
    }

    /**
     * Edit the user's name, provided in the editing form
     * @return bool success status
     */
    public function editUserName($user_id)
    {
        // new username provided ?
        if (!isset($_POST['user_name']) OR empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }

        // new username same as old one ?
        if ($_POST['user_name'] == $_SESSION["user_name"]) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_SAME_AS_OLD_ONE;
            return false;
        }

        // username cannot be empty and must be azAZ09 and 2-64 characters
        if (!preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN;
            return false;
        }

        // clean the input
        $user_name = substr(strip_tags($_POST['user_name']), 0, 64);

        // check if new username already exists
        $query = $this->db->prepare("SELECT user_id FROM tb_users WHERE user_name = :user_name");
        $query->execute(array(':user_name' => $user_name));
        $count =  $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_ALREADY_TAKEN;
            return false;
        }

        $query = $this->db->prepare("UPDATE tb_users SET user_name = :user_name WHERE user_id = :user_id");
        $query->execute(array(':user_name' => $user_name, ':user_id' => $user_id));
        $count =  $query->rowCount();
        if ($count == 1) {
            if (isset($_SESSION['admin_logged_in'])) {
                $_SESSION["feedback_positive"][] = FEEDBACK_USERNAME_CHANGE_SUCCESSFUL;
                return true;
            } else {
                Session::set('user_name', $user_name);
                $_SESSION["feedback_positive"][] = FEEDBACK_USERNAME_CHANGE_SUCCESSFUL;
                return true;
            }
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
            return false;
        }
    }

    /**
     * Edit the user's email, provided in the editing form
     * @return bool success status
     */
    public function editUserEmail($user_id)
    {
        // email provided ?
        if (!isset($_POST['user_email']) OR empty($_POST['user_email'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }

        // check if new email is same like the old one
        if ($_POST['user_email'] == $_SESSION["user_email"]) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_SAME_AS_OLD_ONE;
            return false;
        }

        // user's email must be in valid email format
        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN;
            return false;
        }

        // check if user's email already exists
        $query = $this->db->prepare("SELECT * FROM tb_users WHERE user_email = :user_email");
        $query->execute(array(':user_email' => $_POST['user_email']));
        $count =  $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USER_EMAIL_ALREADY_TAKEN;
            return false;
        }

        // cleaning and write new email to database
        $user_email = substr(strip_tags($_POST['user_email']), 0, 64);
        $query = $this->db->prepare("UPDATE tb_users SET user_email = :user_email WHERE user_id = :user_id");
        $query->execute(array(':user_email' => $user_email, ':user_id' => $user_id));
        $count =  $query->rowCount();
        if ($count != 1) {
            $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
            return false;
        }

        Session::set('user_email', $user_email);
        // call the setGravatarImageUrl() method which writes gravatar URLs into the session
        $this->setGravatarImageUrl($user_email, AVATAR_SIZE);
        $_SESSION["feedback_positive"][] = FEEDBACK_EMAIL_CHANGE_SUCCESSFUL;
        return false;
    }

    /**
     * checks the email/verification code combination and set the user's activation status to true in the database
     * @param int $user_id user id
     * @param string $user_activation_verification_code verification token
     * @return bool success status
     */
    public function verifyNewUser($user_id, $user_activation_verification_code)
    {
        $sth = $this->db->prepare("UPDATE tb_users
                                   SET user_active = 1, user_activation_hash = NULL
                                   WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash");
        $sth->execute(array(':user_id' => $user_id, ':user_activation_hash' => $user_activation_verification_code));

        if ($sth->rowCount() == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_ACTIVATION_FAILED;
            return false;
        }
    }
    
    public function deactivateUser($user_id)
    {   
        $sth = $this->db->prepare("UPDATE tb_users
                                   SET user_active = 0
                                   WHERE user_id = :user_id");
        $sth->execute(array(':user_id' => $user_id));
        $count = $sth->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_USER_DEACTIVATE_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_USER_ACTION_FAILED;
            return false;
        }
    }
    
    public function acceptNewUser()
    {   
        $sth = $this->db->prepare("UPDATE tb_users
                                   SET user_active = 1, user_activation_hash = NULL
                                   WHERE user_id = :user_id");
        $sth->execute(array(':user_id' => $_POST['user_id']));
        $count = $sth->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_USER_ACCEPT_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_USER_ACTION_FAILED;
            return false;
        }
    }
    
    public function rejectNewUser()
    {
        $sth = $this->db->prepare("DELETE FROM tb_users
                                   WHERE user_id = :user_id");
        $sth->execute(array(':user_id' => $_POST['user_id']));
        $count = $sth->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_USER_REJECT_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_USER_ACTION_FAILED;
            return false;
        }
    }
    
    public function deleteUser($user_id)
    {   
        if ($user_id == 1) {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
            return false;
        } else {
            $sth = $this->db->prepare("DELETE FROM tb_users
                                       WHERE user_id = :user_id");
            $sth->execute(array(':user_id' => $user_id));
            $count = $sth->rowCount();
        }
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_USER_DELETE_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_USER_ACTION_FAILED;
            return false;
        }
    }
    
    /**
     * Perform the necessary actions to send a password reset mail
     * @return bool success status
     */
    public function requestPasswordReset()
    {
        // perform all necessary form checks
        if (!$this->checkCaptcha()) {
            $_SESSION["feedback_negative"][] = FEEDBACK_CAPTCHA_WRONG;
        } elseif (empty($_POST['user_provider_type'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
        } elseif (empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
        } elseif (strlen($_POST['user_name']) > 64 OR strlen($_POST['user_name']) < 5) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG;
        } else {
            // generate integer-timestamp (to see when exactly the user (or an attacker) requested the password reset mail)
            $temporary_timestamp = time();
            // generate random hash for email password reset verification (40 char string)
            $user_password_reset_hash = sha1(uniqid(mt_rand(), true));
            // clean user input
            $user_name = strip_tags($_POST['user_name']);
            $user_provider_type = $_POST['user_provider_type'];

            // check if that username exists
            $query = $this->db->prepare("SELECT user_id, user_email FROM tb_users
                                         WHERE (user_name = :user_name OR user_email = :user_name) AND user_provider_type = :provider_type");
            $query->execute(array(':user_name' => $user_name, ':provider_type' => $user_provider_type));
            $count = $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USER_DOES_NOT_EXIST;
                return false;
            }

            // get result
            $result_user_row = $result = $query->fetch();
            $user_email = $result_user_row->user_email;

            // set token (= a random hash string and a timestamp) into database
            if ($this->setPasswordResetDatabaseToken($user_name, $user_provider_type, $user_password_reset_hash, $temporary_timestamp) == true) {
                if (Auth::isInternetAvailible(CHECK_URL, 80) == true) {
                    if ($this->sendPasswordResetMail($user_name, $user_password_reset_hash, $user_email)) {
                        return true;
                    } else {
                        $_SESSION["feedback_positive"][] = FEEDBACK_CONTACT_ADMINISTRATOR;
                        return false;
                    }
                }
            }
        }
        // default return
        return false;
    }

    /**
     * Set password reset token in database (for DEFAULT user accounts)
     * @param string $user_name username
     * @param string $user_password_reset_hash password reset hash
     * @param int $temporary_timestamp timestamp
     * @return bool success status
     */
    public function setPasswordResetDatabaseToken($user_name, $user_provider_type, $user_password_reset_hash, $temporary_timestamp)
    {
        $query_two = $this->db->prepare("UPDATE tb_users
                                            SET user_password_reset_hash = :user_password_reset_hash,
                                                user_password_reset_timestamp = :user_password_reset_timestamp
                                          WHERE user_name = :user_name AND user_provider_type = :provider_type");
        $query_two->execute(array(':user_password_reset_hash' => $user_password_reset_hash,
                                  ':user_password_reset_timestamp' => $temporary_timestamp,
                                  ':user_name' => $user_name,
                                  ':provider_type' => $user_provider_type));

        // check if exactly one row was successfully changed
        $count =  $query_two->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_RESET_TOKEN_FAIL;
            return false;
        }
    }
    
    /**
     * Verifies the password reset request via the verification hash token (that's only valid for one hour)
     * @param string $user_name Username
     * @param string $verification_code Hash token
     * @return bool Success status
     */
    public function verifyPasswordReset($user_name, $verification_code)
    {
        // check if user-provided username + verification code combination exists
        $query = $this->db->prepare("SELECT user_id, user_password_reset_timestamp
                                       FROM tb_users
                                      WHERE user_name = :user_name
                                        AND user_password_reset_hash = :user_password_reset_hash");
        $query->execute(array(':user_password_reset_hash' => $verification_code,
                              ':user_name' => $user_name));

        // if this user with exactly this verification hash code exists
        if ($query->rowCount() != 1) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST;
            return false;
        }

        // get result row (as an object)
        $result_user_row = $query->fetch();
        // 3600 seconds are 1 hour
        $timestamp_one_hour_ago = time() - 3600;
        // if password reset request was sent within the last hour (this timeout is for security reasons)
        if ($result_user_row->user_password_reset_timestamp > $timestamp_one_hour_ago) {
            // verification was successful
            $_SESSION["feedback_positive"][] = FEEDBACK_PASSWORD_RESET_LINK_VALID;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_RESET_LINK_EXPIRED;
            return false;
        }
    }

    /**
     * Set the new password (for DEFAULT user, FACEBOOK-users don't have a password)
     * Please note: At this point the user has already pre-verified via verifyPasswordReset() (within one hour),
     * so we don't need to check again for the 60min-limit here. In this method we authenticate
     * via username & password-reset-hash from (hidden) form fields.
     * @return bool success state of the password reset
     */
    public function setNewPassword()
    {
        // basic checks
        if (!isset($_POST['user_name']) OR empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['user_password_reset_hash']) OR empty($_POST['user_password_reset_hash'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_RESET_TOKEN_MISSING;
            return false;
        }
        if (!isset($_POST['reset_input_password']) OR empty($_POST['reset_input_password'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['reset_input_password_repeat']) OR empty($_POST['reset_input_password_repeat'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }
        // password does not match password repeat
        if ($_POST['reset_input_password'] !== $_POST['reset_input_password_repeat']) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_REPEAT_WRONG;
            return false;
        }
        // password too short
        if (strlen($_POST['reset_input_password']) < 5) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_TOO_SHORT;
            return false;
        }

        $user_password_hash = sha1($_POST['reset_input_password']);

        // write users new password hash into database, reset user_password_reset_hash
        $query = $this->db->prepare("UPDATE tb_users
                                        SET user_password = :user_password_hash,
                                            user_password_reset_hash = NULL,
                                            user_password_reset_timestamp = NULL
                                      WHERE user_name = :user_name
                                        AND user_password_reset_hash = :user_password_reset_hash");

        $query->execute(array(':user_password_hash' => $user_password_hash,
                              ':user_name' => $_POST['user_name'],
                              ':user_password_reset_hash' => $_POST['user_password_reset_hash']));

        // check if exactly one row was successfully changed:
        if ($query->rowCount() == 1) {
            // successful password change!
            $_SESSION["feedback_positive"][] = FEEDBACK_PASSWORD_CHANGE_SUCCESSFUL;
            return true;
        }

        // default return
        $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_CHANGE_FAILED;
        return false;
    }

    /**
     * Upgrades/downgrades the user's account (for DEFAULT and FACEBOOK users)
     * Currently it's just the field user_account_type in the database that
     * can be 1 or 2 (maybe "basic" or "premium"). In this basic method we
     * simply increase or decrease this value to emulate an account upgrade/downgrade.
     * Put some more complex stuff in here, maybe a pay-process or whatever you like.
     */
    public function changeAccountType()
    {
        if (isset($_POST["user_account_upgrade"]) AND !empty($_POST["user_account_upgrade"])) {

            // do whatever you want to upgrade the account here (pay-process etc)
            // ...
            // ... myPayProcess();
            // ...

            // upgrade account type
            $query = $this->db->prepare("UPDATE users SET user_account_type = 2 WHERE user_id = :user_id");
            $query->execute(array(':user_id' => $_SESSION["user_id"]));

            if ($query->rowCount() == 1) {
                // set account type in session to 2
                Session::set('user_account_type', 2);
                $_SESSION["feedback_positive"][] = FEEDBACK_ACCOUNT_UPGRADE_SUCCESSFUL;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_UPGRADE_FAILED;
            }
        } elseif (isset($_POST["user_account_downgrade"]) AND !empty($_POST["user_account_downgrade"])) {

            // do whatever you want to downgrade the account here (pay-process etc)
            // ...
            // ... myWhateverProcess();
            // ...

            $query = $this->db->prepare("UPDATE users SET user_account_type = 1 WHERE user_id = :user_id");
            $query->execute(array(':user_id' => $_SESSION["user_id"]));

            if ($query->rowCount() == 1) {
                // set account type in session to 1
                Session::set('user_account_type', 1);
                $_SESSION["feedback_positive"][] = FEEDBACK_ACCOUNT_DOWNGRADE_SUCCESSFUL;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_DOWNGRADE_FAILED;
            }
        }
    }

    /**
     * Generates the captcha, "returns" a real image,
     * this is why there is header('Content-type: image/jpeg')
     * Note: This is a very special method, as this is echoes out binary data.
     * Eventually this is something to refactor
     */
    public function generateCaptcha()
    {
        // create a captcha with the CaptchaBuilder lib
        $builder = new CaptchaBuilder;
        $builder->build();

        // write the captcha character into session
        $_SESSION['captcha'] = $builder->getPhrase();

        // render an image showing the characters (=the captcha)
        header('Content-type: image/jpeg');
        $builder->output();
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
    
    /*
     * LOGIN/REGISTER FUNCTIONS
     */
    
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

        $query = $this->db->prepare("SELECT tb_users.*, tb_branch.*
                FROM tb_users
                LEFT JOIN tb_branch on tb_users.branch_id = tb_branch.branch_id
                WHERE (user_name = :user_name OR user_email = :user_name)");

        $query->execute(array(':user_name' => $_POST['user_name']));
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
            if ($result->user_account_type != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_INCORRECT_LOGIN;
                return false;
            }
            if ($result->user_provider_type == NULL) {
                $_SESSION["feedback_negative"][] = FEEDBACK_INCORRECT_LOGIN;
                return false;
            }

                // login process, write the user data into session
                Session::init();
                $type = $result->user_provider_type;
                Auth::setuser($type);
                Session::set('user_id', $result->user_id);
                Session::set('user_name', $result->user_name);
                Session::set('user_email', $result->user_email);
                Session::set('first_name', $result->first_name);
                Session::set('last_name', $result->last_name);
                Session::set('branch_id', $result->branch_id);
                Session::set('branch', $result->branch_name . ',&nbsp;' . $result->branch_address);
                Session::set('user_account_type', $result->user_account_type);
                Session::set('user_provider_type', $result->user_provider_type);

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
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_WRONG;
            return false;
        }

        // default return
        return false;
    }
    
    public function logout($session) {
        if (isset($session)) {
            Session::destroy();
            Session::init();
            $_SESSION["feedback_positive"][] = FEEDBACK_LOGGED_OUT;
            return true;
        }
    }

    public function registerNewUser() {
        // perform all necessary form checks
        if (!$this->checkCaptcha()) {
            $_SESSION["feedback_negative"][] = FEEDBACK_CAPTCHA_WRONG;
        } elseif (empty($_POST['user_provider_type'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERTYPE_FIELD_EMPTY;
        } elseif (empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
        } elseif (empty($_POST['branch_id'])) {
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

            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character
            // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4,
            // by the password hashing compatibility library. the third parameter looks a little bit shitty, but that's
            // how those PHP 5.5 functions want the parameter: as an array with, currently only used with 'cost' => XX
            // $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
            // $user_password_hash = password_hash($_POST['user_password_new'], PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            
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

            // generate unique user id
            $new_user_id = rand(1, 999999);
            // generate random hash for email verification (40 char string)
            $user_activation_hash = sha1(uniqid(mt_rand(), true));
            // generate integer-timestamp for saving of account-creating date
            $user_creation_timestamp = time();

            // write new users data into database
            $sql = "INSERT INTO tb_users (user_id, user_name, user_password, user_email, first_name, last_name, middle_name, branch_id, user_creation_timestamp, user_activation_hash, user_provider_type)
                    VALUES (:user_id, :user_name, :user_password, :user_email, :first_name, :last_name, :middle_name, :branch_id, :user_creation_timestamp, :user_activation_hash, :user_provider_type)";
            $query = $this->db->prepare($sql);
            $query->execute(array(':user_id' => $new_user_id,
                                  ':user_name' => $user_name,
                                  ':user_password' => $user_password_hash,
                                  ':user_email' => $user_email,
                                  ':first_name' => strtoupper($_POST['first_name']),
                                  ':last_name' => strtoupper($_POST['last_name']),
                                  ':middle_name' => strtoupper($_POST['middle_name']),
                                  ':branch_id' => $_POST['branch_id'],
                                  ':user_creation_timestamp' => $user_creation_timestamp,
                                  ':user_activation_hash' => $user_activation_hash,
                                  ':user_provider_type' => $_POST['user_provider_type']));
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

            // send verification email, if verification email sending failed: instantly delete the user
            
            // send verification email, if verification email sending failed: sends to administrator instead
            if (Auth::isInternetAvailible(CHECK_URL, 80) == true) {
                $this->sendVerificationEmail($user_id, $user_email, $user_activation_hash);
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
    
    /*
     * END
     */
    
    /**
     * sends an email to the provided email address
     * @param int $user_id user's id
     * @param string $user_email user's email
     * @param string $user_activation_hash user's mail verification hash string
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
    {
        // create PHPMailer object (this is easily possible as we auto-load the according class(es) via composer)
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        if (EMAIL_USE_SMTP) {
            // set PHPMailer to use SMTP
            $mail->IsSMTP();
            // useful for debugging, shows full SMTP errors, config this in config/config.php
            $mail->SMTPDebug = PHPMAILER_DEBUG_MODE;
            // enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // enable encryption, usually SSL/TLS
            if (defined('EMAIL_SMTP_ENCRYPTION')) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // set SMTP provider's credentials
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        // fill mail with data
        $mail->From = EMAIL_VERIFICATION_FROM_EMAIL;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;
        $mail->Body = EMAIL_VERIFICATION_CONTENT . EMAIL_VERIFICATION_URL . '/' . urlencode($user_id) . '/' . urlencode($user_activation_hash);

        // final sending and check
        if($mail->Send()) {
            $_SESSION["feedback_positive"][] = FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL;
            return true;
        } else {
            //$_SESSION["feedback_negative"][] = FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR . $mail->ErrorInfo;
            return false;
        }
    }
    
    /**
     * send the password reset mail
     * @param string $user_name username
     * @param string $user_password_reset_hash password reset hash
     * @param string $user_email user email
     * @return bool success status
     */
    public function sendPasswordResetMail($user_name, $user_password_reset_hash, $user_email)
    {
        // create PHPMailer object here. This is easily possible as we auto-load the according class(es) via composer
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors, config this in config/config.php
            $mail->SMTPDebug = PHPMAILER_DEBUG_MODE;
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined('EMAIL_SMTP_ENCRYPTION')) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        // build the email
        $mail->From = EMAIL_PASSWORD_RESET_FROM_EMAIL;
        $mail->FromName = EMAIL_PASSWORD_RESET_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_PASSWORD_RESET_SUBJECT;
        $link = EMAIL_PASSWORD_RESET_URL . '/' . urlencode($user_name) . '/' . urlencode($user_password_reset_hash);
        $mail->Body = EMAIL_PASSWORD_RESET_CONTENT . ' ' . $link;

        // send the mail
        if($mail->Send()) {
            $_SESSION["feedback_positive"][] = FEEDBACK_PASSWORD_RESET_MAIL_SENDING_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_RESET_MAIL_SENDING_ERROR . $mail->ErrorInfo;
            return false;
        }
    }

}
