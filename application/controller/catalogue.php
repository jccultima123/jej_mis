<?php

/*
 * Catalogue Controller for public site
 */

class Catalogue extends PublicController {
    
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        $this->category_model = $this->loadModel('Category');
    }
    
    function index()
    {
        $latest_prod_time = $this->product_model->getLatestTime();
        $product_count = $this->product_model->countProducts();
        require VIEWS_PATH . 'CRM/public/header.php';
        require VIEWS_PATH . 'CRM/public/index.php';
        require VIEWS_PATH . 'CRM/public/footer.php';
    }
    
}
