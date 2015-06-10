<?php

/**
 * Class Home
 * 
 * HOME PAGE OF THIS APPLICATION
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class misc extends Controller
{
    function __construct()
    {
        parent::__construct();
        // CORE
        $this->captcha_model = $this->loadModel('Captcha');
    }
    
    public function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
