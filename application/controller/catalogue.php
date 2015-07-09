<?php

/*
 * Catalogue Controller for public site
 */

class Catalogue extends PublicController {
    
    function index()
    {
        View::render('catalogue', 'index', 'default');
    }
    
}
