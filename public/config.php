<?php

/**
 * End-User Configurations
 * It will occur error messages when the config not set correctly
 */

    /*
     * Core
     */
        // EMAIL
        $email = 'blabla@gmail.com';

    /*
     * Environment
     * $env = '';
     * 
     *  -   define('ENVIRONMENT', 'development');
     *      Enables Error Report and Debugging
     * 
     *  -   define('ENVIRONMENT', 'release');
     *      Disables Error Reporting for Performance
     * 
     *  -   define('ENVIRONMENT', 'web');
     *      For Webhosting (don't use if you are about to go development/offline)
     * 
     *  -   define('CHECK_URL', 'your url');
     *      URL to test Internet Connection for sending mails
     */
        $env = 'development';
        
    /*
     * View Configurations
     * init (i.e.) = app > view > $header
     */
        $header = '_header';
        $footer = '_footer';
        $templates = '_templates';
        
    /*
     * Company Properties
     * 
     */
        $gen_manager = 'GABRIEL JOSE JADUCANA';
        $com_recieved = 'JUAN DELA CRUZ';
         