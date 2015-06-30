<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/*
 * Time Zones
 * To see all current timezones, @see http://php.net/manual/en/timezones.php
 */
date_default_timezone_set("Asia/Manila");

/**
 * CORE
 * Environment Settings
 * 
 *  -   define('ENVIRONMENT', 'development');
 *      Enables Error Report and Debugging
 * 
 *  -   define('ENVIRONMENT', 'release');
 *      Disables Error Reporting for Performance
 * 
 *  -   define('CHECK_URL', 'your url');
 *      URL to test Internet Connection for sending mails
 * 
 */
define('ENVIRONMENT', 'development');
define('CHECK_URL', 'google.com');

define('DATE_CUSTOM', 'D, F j, Y, g:i a');
define('DATE_MMDDYY', 'M d, Y');

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            break;
        case 'release':
            error_reporting(0);
            ini_set('display_errors', 0);
            break;
        default:
            $ERROR = 'The application environment is not set correctly.';
            require_once '_fb/error.html';
            exit();
    }
}

/*
 * Note that when using PDO to access a MySQL database real prepared statements are not used by default.
 * To fix this you have to disable the emulation of prepared statements.
 * This way the script will not stop with a Fatal Error when something goes wrong.
 * And it gives the developer the chance to catch any error(s) which are thrown as PDOExceptions.
 * What is mandatory however is the first setAttribute() line, which
 * tells PDO to disable emulated prepared statements and use real prepared
 * statements. This makes sure the statement and the values aren't parsed by PHP before
 * sending it to the MySQL server (giving a possible attacker no chance to inject malicious SQL).
 */
define('EMULATED_SQL', false);

/*
 * Default Configuration for pagination
 */
define('STARTING_PAGE', 0);
define('ITEM_PER_PAGE', 10);

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('LIBS_PATH', APP . 'libs' . DIRECTORY_SEPARATOR);
define('CONTROLLERS_PATH', APP . 'controller' . DIRECTORY_SEPARATOR);
define('MODELS_PATH', APP . 'model' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', APP . 'view' . DIRECTORY_SEPARATOR);

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_jejdatacenter');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');

/**
 * Configuration for: Cookies
 * Please note: The COOKIE_DOMAIN needs the domain where your app is,
 * in a format like this: .mydomain.com
 * Note the . in front of the domain. No www, no http, no slash here!
 * For local development .127.0.0.1 or .localhost is fine, but when deploying you should
 * change this to your real domain, like '.mydomain.com' ! The leading dot makes the cookie available for
 * sub-domains too.
 * @see http://stackoverflow.com/q/9618217/1114320
 * @see http://www.php.net/manual/en/function.setcookie.php
 *
 * COOKIE_RUNTIME: How long should a cookie be valid ? 1209600 seconds = 2 weeks
 * COOKIE_DOMAIN: The domain where the cookie is valid for, like '.mydomain.com'
 * COOKIE_SECRET_KEY: Put a random value here to make your app more secure. When changed, all cookies are reset.
 */
define("COOKIE_RUNTIME", 1209600);
define("COOKIE_DOMAIN", ".localhost");
define("COOKIE_SECRET_KEY", "1gp@TMPS{+$78sfpMJFe-92s");

/**
 * Configuration for: Email server credentials
 *
 * Here you can define how you want to send emails.
 * If you have successfully set up a mail server on your linux server and you know
 * what you do, then you can skip this section. Otherwise please set EMAIL_USE_SMTP to true
 * and fill in your SMTP provider account data.
 *
 * An example setup for using gmail.com [Google Mail] as email sending service,
 * works perfectly in August 2013. Change the "xxx" to your needs.
 * Please note that there are several issues with gmail, like gmail will block your server
 * for "spam" reasons or you'll have a daily sending limit. See the readme.md for more info.
 *
 * define("EMAIL_USE_SMTP", true);
 * define("EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
 * define("EMAIL_SMTP_AUTH", true);
 * define("EMAIL_SMTP_USERNAME", "xxxxxxxxxx@gmail.com");
 * define("EMAIL_SMTP_PASSWORD", "xxxxxxxxxxxxxxxxxxxx");
 * define("EMAIL_SMTP_PORT", 465);
 * define("EMAIL_SMTP_ENCRYPTION", "ssl");
 *
 * It's really recommended to use SMTP!
 *
 */

// DEBUG MODE! Options: 0 = off, 1 = commands, 2 = commands and data, perfect to see SMTP errors, see the PHPMailer manual for more
define("PHPMAILER_DEBUG_MODE", 2);

define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "johncyrill.corsanes@my.jru.edu");
define("EMAIL_SMTP_PASSWORD", "corsanes");
define("EMAIL_SMTP_PORT", 465);
define("EMAIL_SMTP_ENCRYPTION", "ssl");

define("EMAIL_BR", "\r\n");

/**
 * Configuration for: password reset email data
 * Set the absolute URL to password_reset.php, necessary for email password reset links
 */
define("EMAIL_PASSWORD_RESET_URL", URL . "passwordaction/verifyPasswordReset");
define("EMAIL_PASSWORD_RESET_FROM", "no-reply@jejadmin.com");
define("EMAIL_PASSWORD_RESET_FROM_NAME", "Administrator");
define("EMAIL_PASSWORD_RESET_SUBJECT", "Password reset for JEJ MIS PROJECT");
define("EMAIL_PASSWORD_RESET_CONTENT", "We've been found your missing account and your password was about to reset WITHIN ONLY 1 HOUR. To continue, \r\nPlease go to this link:");
define("EMAIL_PASSWORD_RESET_DISREGARD", "If you are now be able to login with your previous password, PLEASE DIRSREGARD this message. Thank You!");

/**
 * Configuration for: verification email data
 * Set the absolute URL to register.php, necessary for email verification links
 */
define("EMAIL_VERIFICATION_URL", URL . "users/verify");
define("EMAIL_VERIFICATION_FROM", "no-reply@jejadmin.com");
define("EMAIL_VERIFICATION_FROM_NAME", "Administrator");
define("EMAIL_VERIFICATION_SUBJECT", "Account activation for JEJ MIS PROJECT");
define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account: ");

/**
 * Configuration for: verification success data
 */

/**
 * Configuration for: Hashing strength
 * This is the place where you define the strength of your password hashing/salting
 *
 * To make password encryption very safe and future-proof, the PHP 5.5 hashing/salting functions
 * come with a clever so called COST FACTOR. This number defines the base-2 logarithm of the rounds of hashing,
 * something like 2^12 if your cost factor is 12. By the way, 2^12 would be 4096 rounds of hashing, doubling the
 * round with each increase of the cost factor and therefore doubling the CPU power it needs.
 * Currently, in 2013, the developers of this functions have chosen a cost factor of 10, which fits most standard
 * server setups. When time goes by and server power becomes much more powerful, it might be useful to increase
 * the cost factor, to make the password hashing one step more secure. Have a look here
 * (@see https://github.com/panique/php-login/wiki/Which-hashing-&-salting-algorithm-should-be-used-%3F)
 * in the BLOWFISH benchmark table to get an idea how this factor behaves. For most people this is irrelevant,
 * but after some years this might be very very useful to keep the encryption of your database up to date.
 *
 * Remember: Every time a user registers or tries to log in (!) this calculation will be done.
 * Don't change this if you don't know what you do.
 *
 * To get more information about the best cost factor please have a look here
 * @see http://stackoverflow.com/q/4443476/1114320
 *
 * This constant will be used in the login and the registration class.
 */
define("HASH_COST_FACTOR", "10");

/**
 * Configuration for: Avatars/Gravatar support
 * Set to true if you want to use "Gravatar(s)", a service that automatically gets avatar pictures via using email
 * addresses of users by requesting images from the gravatar.com API. Set to false to use own locally saved avatars.
 * AVATAR_SIZE set the pixel size of avatars/gravatars (will be 44x44 by default). Avatars are always squares.
 * AVATAR_DEFAULT_IMAGE is the default image in public/avatars/
 */
define('USE_GRAVATAR', false);
define('AVATAR_SIZE', 44);
define('AVATAR_JPEG_QUALITY', 85);
define('AVATAR_DEFAULT_IMAGE', 'default.jpg');

/**
 * Configuration for: Error messages and notices
 *
 * In this project, the error messages, notices etc are all-together called "feedback".
 * 
 * REMINDER:
 * You may call the error anytime by initializing the Session first
 */

define("FEEDBACK_UNKNOWN_ERROR", "Unknown error occurred!");
define("FEEDBACK_PASSWORD_WRONG", "Password was wrong.");
define("FEEDBACK_PASSWORD_WRONG_3_TIMES", "You have typed in a wrong password 3 or more times already. Please wait 30 seconds to try again.");
define("FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET", "Your account is not activated yet. Please confirm from your administrator or to your email.");
define("FEEDBACK_INCORRECT_LOGIN", "ACCESS DENIED. Maybe you are not authorized.");
define("FEEDBACK_INVALID_LOGIN", "");
define("FEEDBACK_USER_DOES_NOT_EXIST", "This user does not exist.");
define("FEEDBACK_USERNAME_FIELD_EMPTY", "Username field was empty.");
define("FEEDBACK_PASSWORD_FIELD_EMPTY", "Password field was empty.");
define("FEEDBACK_EMAIL_FIELD_EMPTY", "Email and passwords fields were empty.");
define("FEEDBACK_EMAIL_AND_PASSWORD_FIELDS_EMPTY", "Email field was empty.");
define("FEEDBACK_USERNAME_SAME_AS_OLD_ONE", "Sorry, that username is the same as your current one. Please choose another one.");
define("FEEDBACK_USERNAME_ALREADY_TAKEN", "Sorry, that username is already taken. Please choose another one.");
define("FEEDBACK_USER_EMAIL_ALREADY_TAKEN", "Sorry, that email is already in use. Please choose another one.");
define("FEEDBACK_USERNAME_CHANGE_SUCCESSFUL", "Username has been changed successfully.");
define("FEEDBACK_USERNAME_AND_PASSWORD_FIELD_EMPTY", "Username and password fields were empty.");
define("FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN", "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters.");
define("FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN", "Sorry, your chosen email does not fit into the email naming pattern.");
define("FEEDBACK_EMAIL_SAME_AS_OLD_ONE", "Sorry, that email address is the same as your current one. Please choose another one.");
define("FEEDBACK_EMAIL_CHANGE_SUCCESSFUL", "Your email address has been changed successfully.");
define("FEEDBACK_CAPTCHA_WRONG", "The entered captcha security characters were wrong.");
define("FEEDBACK_PASSWORD_REPEAT_WRONG", "Password and password repeat are not the same.");
define("FEEDBACK_PASSWORD_TOO_SHORT", "Password has a minimum length of 6 characters.");
define("FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG", "Username cannot be shorter than 6 or longer than 64 characters.");
define("FEEDBACK_EMAIL_TOO_LONG", "Email cannot be longer than 64 characters.");
define("FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED", "Your registration has been sent to the Administrator.");
define("FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED_NOEMAIL", "Our email service might not be sent at this moment, but your registration has been sent to the Administrator instead.");
define("FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED", "Sorry, we could not send you an verification mail. Your account has NOT been created.");
define("FEEDBACK_ACCOUNT_CREATION_FAILED", "Sorry, your registration failed was failed. Please try again.");
define("FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR", "Verification mail could not be sent due to: ");
define("FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL", "A verification mail has been sent successfully.");
define("FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL", "Activation was successful! You can now log in.");
define("FEEDBACK_ACCOUNT_ACTIVATION_FAILED", "Sorry, no such id/verification code combination here...");
define("FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL", "Avatar upload was successful.");
define("FEEDBACK_AVATAR_UPLOAD_WRONG_TYPE", "Only JPEG and PNG files are supported.");
define("FEEDBACK_AVATAR_UPLOAD_TOO_SMALL", "Avatar source file's width/height is too small. Needs to be 100x100 pixel minimum.");
define("FEEDBACK_AVATAR_UPLOAD_TOO_BIG", "Avatar source file is too big. 5 Megabyte is the maximum.");
define("FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE", "Avatar folder does not exist or is not writable. Please change this via chmod 775 or 777.");
define("FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED", "Something went wrong with the image upload.");
define("FEEDBACK_PASSWORD_RESET_TOKEN_FAIL", "Could not write token to database.");
define("FEEDBACK_PASSWORD_RESET_TOKEN_MISSING", "No password reset token.");
define("FEEDBACK_PASSWORD_RESET_MAIL_SENDING_ERROR", "Password reset mail could not be sent due to: ");
define("FEEDBACK_PASSWORD_RESET_MAIL_SENDING_SUCCESSFUL", "A password reset mail has been sent successfully.");
define("FEEDBACK_PASSWORD_RESET_LINK_EXPIRED", "Your reset link has expired. Please use the reset link within one hour.");
define("FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST", "Username/Verification code combination does not exist.");
define("FEEDBACK_PASSWORD_RESET_LINK_VALID", "Password reset validation link is valid. Please change the password now.");
define("FEEDBACK_PASSWORD_CHANGE_SUCCESSFUL", "Password successfully changed.");
define("FEEDBACK_PASSWORD_CHANGE_FAILED", "Sorry, your password changing failed.");
define("FEEDBACK_ACCOUNT_UPGRADE_SUCCESSFUL", "Account upgrade was successful.");
define("FEEDBACK_ACCOUNT_UPGRADE_FAILED", "Account upgrade failed.");
define("FEEDBACK_ACCOUNT_DOWNGRADE_SUCCESSFUL", "Account downgrade was successful.");
define("FEEDBACK_ACCOUNT_DOWNGRADE_FAILED", "Account downgrade failed.");
define("FEEDBACK_NOTE_CREATION_FAILED", "Note creation failed.");
define("FEEDBACK_NOTE_EDITING_FAILED", "Note editing failed.");
define("FEEDBACK_NOTE_DELETION_FAILED", "Note deletion failed.");
define("FEEDBACK_COOKIE_MISSING", "Your remember-me-cookie is missing.");
define("FEEDBACK_COOKIE_INVALID", "Your remember-me-cookie is invalid.");
define("FEEDBACK_COOKIE_LOGIN_SUCCESSFUL", "<b>NOTE:</b> You are logged in until the 14th day.");

/** CUSTOM ERRORS **/
define("FEEDBACK_MISSING_ITEM", "The file" . $lib . "was missing. ");
define("FEEDBACK_LOGIN_FIRST", "Login First.");
define("FEEDBACK_INVALID_LOGOUT", "You've been logout before.");
define("FEEDBACK_LOGGED_OUT", "You've been logout at " . date(DATE_CUSTOM) . ".");
define("FEEDBACK_PAGE_NOT_AVAILABLE", "Sorry, this page is not available for now.");
define("FEEDBACK_ITEM_NOT_AVAILABLE", "No Results.");
define("FEEDBACK_UNDER_DEVELOPMENT", "HI! This System is still under development. Sorry for any inconvenience.");

define("FEEDBACK_FIRSTNAME_FIELD_EMPTY", "First Name field was empty.");
define("FEEDBACK_LASTNAME_FIELD_EMPTY", "Last Name field was empty.");
define("FEEDBACK_MIDDLE_FIELD_EMPTY", "Middle Name field was empty.");
define("FEEDBACK_USERTYPE_FIELD_EMPTY", "User Type field was empty.");
define("FEEDBACK_BRANCH_FIELD_EMPTY", "User Branch field was empty.");

define("FEEDBACK_NO_USERS", "No any users found on the database.  <a href=" . URL . "admin/userRegister" . "><u>Click me here to CREATE</u></a>");
define("FEEDBACK_NO_ITEMS", "No any items found on this page or database.");
define("FEEDBACK_USER_ACCEPT_SUCCESSFUL", "You've just activated that user.");
define("FEEDBACK_USER_REJECT_SUCCESSFUL", "You've just rejected the user.");
define("FEEDBACK_USER_DELETE_SUCCESSFUL", "You've just dismissed that user.");
define("FEEDBACK_USER_DEACTIVATE_SUCCESSFUL", "You've just deactivated that user.");
define("FEEDBACK_USER_ACTION_FAILED", "Sorry, unable to process the user. Please Try Again.");
define("FEEDBACK_CONTACT_ADMINISTRATOR", 'The email server might be offline at this moment. Please contact Administrator <a href="' . URL . 'sendmessage">Here</a>');
define("FEEDBACK_USER_CLEANED", "Some Unfinished Registrations was been cleaned.");
define("FEEDBACK_ADMIN_ERROR", "Username could not be changed.");

/** CRUD MESSAGES **/
define("CRUD_ADDED", "Added.");
define("CRUD_UPDATED", "Updated.");
define("CRUD_DELETE", "Deleted.");

/** CRUD ERRORS **/
define("CRUD_MISSING_ITEM", "WARNING! Some required items are missing.");
define("CRUD_NOT_FOUND", "Item Not found.");
define("CRUD_UNABLE_TO_ADD", "Unable to add. Item is already defined.");
define("CRUD_UNABLE_TO_EDIT", "Unable to edit.");
define("CRUD_UNABLE_TO_DELETE", "Unable to delete. This might be deleted before or does not exist.");

/** CRUD WARNINGS **/
define("CRUD_WAR_ALREADY_DEF", "WARNING! Some items are already defined.");

/** CRUD CRITICAL ERRORS **/
define("CRUD_CE_UNKNOWN_QUERY", "CRITICAL ERROR! Query Undefined.");