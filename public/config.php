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
     * View Configurations
     * init (i.e.) = app > view > $header
     */
        $header = '_header';
        $footer = '_footer';
        $templates = '_templates';

         