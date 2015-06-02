<?php

class Users extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
        $this->user_model = $this->loadModel('User');
        $this->branch_model = $this->loadModel('Branch');
    }

    // VIEWS
    
        /**
         * This method controls what happens when you move to /dashboard/index in your app.
         */
        function index()
        {
            $users = $this->user_model->getAllUsers();
            require APP . 'view/_templates/header.php';
            require APP . 'view/user/index.php';
            require APP . 'view/_templates/footer.php';
        }
    
    // -------
        
    // ACTIONS/CONTROLLER

       /**
       * Show user's profile
       */
       function showProfile()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           Auth::handleLogin();
           $this->view->render('user/showprofile');
       }

       /**
        * Edit user name (show the view with the form)
        */
       function editUsername()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           Auth::handleLogin();
           $this->view->render('user/editusername');
       }

       /**
        * Edit user name (perform the real action after form has been submitted)
        */
       function editUsername_action()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           // Note: This line was missing in early version of the script, but it was never a real security issue as
           // it was not possible to read or edit anything in the database unless the user is really logged in and
           // has a valid session.
           Auth::handleLogin();
           $login_model = $this->loadModel('Login');
           $login_model->editUserName();
           $this->view->render('user/editusername');
       }

       /**
        * Edit user email (show the view with the form)
        */
       function editUserEmail()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           Auth::handleLogin();
           $this->view->render('user/edituseremail');
       }

       /**
        * Edit user email (perform the real action after form has been submitted)
        */
       function editUserEmail_action()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           // Note: This line was missing in early version of the script, but it was never a real security issue as
           // it was not possible to read or edit anything in the database unless the user is really logged in and
           // has a valid session.
           Auth::handleLogin();
           $login_model = $this->loadModel('Login');
           $login_model->editUserEmail();
           $this->view->render('user/edituseremail');
       }

       /**
        * Upload avatar
        */
       function uploadAvatar()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           Auth::handleLogin();
           $login_model = $this->loadModel('Login');
           $this->view->avatar_file_path = $login_model->getUserAvatarFilePath();
           $this->view->render('user/uploadavatar');
       }

       /**
        *
        */
       function uploadAvatar_action()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           // Note: This line was missing in early version of the script, but it was never a real security issue as
           // it was not possible to read or edit anything in the database unless the user is really logged in and
           // has a valid session.
           Auth::handleLogin();
           $login_model = $this->loadModel('Login');
           $login_model->createAvatar();
           $this->view->render('user/uploadavatar');
       }

       /**
        *
        */
       function changeAccountType()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           Auth::handleLogin();
           $this->view->render('user/changeaccounttype');
       }

       /**
        *
        */
       function changeAccountType_action()
       {
           // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
           // Note: This line was missing in early version of the script, but it was never a real security issue as
           // it was not possible to read or edit anything in the database unless the user is really logged in and
           // has a valid session.
           Auth::handleLogin();
           $login_model = $this->loadModel('Login');
           $login_model->changeAccountType();
           $this->view->render('user/changeaccounttype');
       }

       /**
        * Register page
        * Show the register form (with the register-with-facebook button). We need the facebook-register-URL for that.
        */
       function register()
       {
           $login_model = $this->loadModel('Login');

           // if we use Facebook: this is necessary as we need the facebook_register_url in the login form (in the view)
           if (FACEBOOK_LOGIN == true) {
               $this->view->facebook_register_url = $login_model->getFacebookRegisterUrl();
           }

           $this->view->render('user/register');
       }

       /**
        * Register page action (after form submit)
        */
       function register_action()
       {
           $login_model = $this->loadModel('Login');
           $registration_successful = $login_model->registerNewUser();

           if ($registration_successful == true) {
               header('location: ' . URL . 'user/index');
           } else {
               header('location: ' . URL . 'user/register');
           }
       }

       /**
        * Verify user after activation mail link opened
        * @param int $user_id user's id
        * @param string $user_activation_verification_code sser's verification token
        */
       function verify($user_id, $user_activation_verification_code)
       {
           if (isset($user_id) && isset($user_activation_verification_code)) {
               $login_model = $this->loadModel('Login');
               $login_model->verifyNewUser($user_id, $user_activation_verification_code);
               $this->view->render('user/verify');
           } else {
               header('location: ' . URL . 'user/index');
           }
       }

       /**
        * Request password reset page
        */
       function requestPasswordReset()
       {
           $this->view->render('user/requestpasswordreset');
       }

       /**
        * Request password reset action (after form submit)
        */
       function requestPasswordReset_action()
       {
           $login_model = $this->loadModel('Login');
           $login_model->requestPasswordReset();
           $this->view->render('user/requestpasswordreset');
       }

       /**
        * Verify the verification token of that user (to show the user the password editing view or not)
        * @param string $user_name username
        * @param string $verification_code password reset verification token
        */
       function verifyPasswordReset($user_name, $verification_code)
       {
           $login_model = $this->loadModel('Login');
           if ($login_model->verifyPasswordReset($user_name, $verification_code)) {
               // get variables for the view
               $this->view->user_name = $user_name;
               $this->view->user_password_reset_hash = $verification_code;
               $this->view->render('user/changepassword');
           } else {
               header('location: ' . URL . 'user/index');
           }
       }

       /**
        * Set the new password
        * Please note that this happens while the user is not logged in.
        * The user identifies via the data provided by the password reset link from the email.
        */
       function setNewPassword()
       {
           $login_model = $this->loadModel('Login');
           // try the password reset (user identified via hidden form inputs ($user_name, $verification_code)), see
           // verifyPasswordReset() for more
           $login_model->setNewPassword();
           // regardless of result: go to index page (user will get success/error result via feedback message)
           header('location: ' . URL . 'user/index');
       }

       /**
        * Generate a captcha, write the characters into $_SESSION['captcha'] and returns a real image which will be used
        * like this: <img src="......./user/showCaptcha" />
        * IMPORTANT: As this action is called via <img ...> AFTER the real application has finished executing (!), the
        * SESSION["captcha"] has no content when the application is loaded. The SESSION["captcha"] gets filled at the
        * moment the end-user requests the <img .. >
        * If you don't know what this means: Don't worry, simply leave everything like it is ;)
        */
       function showCaptcha()
       {
           $login_model = $this->loadModel('Login');
           $login_model->generateCaptcha();
       }
        
    // -------
}
