<?php

class CRM extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::CRMhandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS
        $this->crm_model = $this->loadModel('CRM');
        $this->catalogue_model = $this->loadModel('Catalogue');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            require View::header('CRM');
        } else {
            require View::header('CRM');
        }
        require VIEWS_PATH . 'CRM/index.php';
        require View::footer('CRM');
    }
    
    function help()
    {
        header('location: ' . URL . 'help/CRM');
    }
    
    public function about()
    {
        require View::header('CRM');
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . 'about/index.php';
        require View::footer('CRM');
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['CRM_user_logged_in']);
        // check login status
        if ($logout == true) {
            $this->audit_model->set_log('Login', 'CRM:' . $_GET['user'] . ' was logged out.');
            header('location: ' . URL . 'mis');
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
    function customers()
    {
        $customers = $this->crm_model->getAllCustomers();
        $customer_count = $this->crm_model->getAmountOfCustomers();
        require View::header('CRM');
        View::adminMode();
        require VIEWS_PATH . 'CRM/customers.php';
        require View::footer('CRM');
    }
    
    function feedbacks()
    {
        $feedbacks = $this->crm_model->getAllFeedbacks();
        $feedback_count = $this->crm_model->countFeedbacks();
        require View::header('CRM');
        View::adminMode();
        require VIEWS_PATH . 'CRM/feedbacks.php';
        require View::footer('CRM');
    }
    
    public function post($type, $id)
    {
        switch ($type) {
            case 'details':
                $details = $this->crm_model->getFeedback($id);
                require View::header('CRM');
                View::adminMode();
                require VIEWS_PATH . 'CRM/feedback/details.php';
                require View::footer('CRM');
                break;
            case 'history':
                $details = $this->crm_model->getFeedbackHistory($id);
                require View::header('CRM');
                View::adminMode();
                if (!$details) {
                    $details = NULL;
                }
                require VIEWS_PATH . 'CRM/feedback/history.php';
                require View::footer('CRM');
                break;
            case 'reply':
                $details = $this->crm_model->getFeedback($id);
                if (isset($details->feedback_id)) {
                    require View::header('CRM');
                    View::adminMode();
                    require VIEWS_PATH . 'CRM/reply.php';
                    require View::footer('CRM');
                } else {
                    header('location: ' . URL . 'CRM/feedbacks');
                }
                break;
            case 'delete':
                $action = $this->crm_model->deleteFeedback($id);
                if ($action == true) {
                    header('location: ' . URL . 'CRM/feedbacks');
                } else {
                    $this->post('details', $id);
                }
                break;
            case 'action':
                if ($id) {
                    $action = $this->crm_model->replyFeedback($id,
                                $_POST['subject'],
                                $_POST['message'],
                                $_POST['email']
                            );
                    if ($action == true) {
                        header('location: ' . URL . 'CRM/feedbacks');
                    } else {
                        $this->post('reply', $id);
                    }
                }
                break;
            default:
                header('location: ' . URL . 'CRM');
        }
    }
    
    function validate($feedback_id)
    {
        $this->catalogue_model->validate($feedback_id);
        header('location: ' . URL . 'CRM/feedbacks');
    }
}
