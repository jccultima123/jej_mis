<?php

/**
 * End-User Configurations
 * It will occur error messages when the config not set correctly
 */

    /*
     * Core
     */
        /* Database Settings (for release only)
         * NOTE:    Only backend will manipulate the whole database for now
         *          Rather use phpmyadmin or command (rename database or change charset for example)
         */
            $type = 'mysql';
            $database = 'jejmobil_datacenter';
            $host = 'localhost';
            $user = 'jejmobil_datacenter';
            $password = 'jejmobil_root';
            $charset = 'utf8';
        /*
         * EXAMPLE:
          $database = 'db_jejdatacenter';
          $host = 'localhost';
          $type = 'mysql';
          $user = 'root';
          $password = 'root';
          $charset = 'utf8';
         */

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
     * Misc Properties
     * 
     */
        //FOR REPORTS
        $gen_manager = 'GABRIEL JOSE JADUCANA';
        $com_recieved = 'JUAN DELA CRUZ';
         