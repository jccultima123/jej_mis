<?php

/*
 * Browser Class -- Consists of several browser dependencies
 */
class BrowserLib
{
    
    public static function detectCompatibility()
    {
        $browser = new Browser();

        if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() <= 9)) {
            $ERROR = 'This system is not compatible with your version of Internet Explorer unless you <a href="http://windows.microsoft.com/en-US/internet-explorer/download-ie" target="_blank">upgrade.</a>';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 7)) {
            $ERROR = 'This system is not compatible with your version of Apple Safari.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if ($browser->getPlatform() == Browser::PLATFORM_BLACKBERRY) {
            $ERROR = 'This system is not compatible with your Blackberry Device.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 35)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_OPERA && $browser->getVersion() <= 13)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 30)) {
            $ERROR = 'This system is not compatible with your version of Google Chrome.';
            require_once '_fb/error_2.html';
            exit;
        }
        //GUI does not work out in Android 3 or later
        else if (($browser->getBrowser() == Browser::BROWSER_ANDROID && $browser->getVersion() < 4)) {
            $ERROR = 'This system is not compatible with your Browser.';
            require_once '_fb/error_2.html';
            exit;
        }
    }

    public static function Check()
    {
        $browser = new Browser();

        if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() <= 9)) {
            return false;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 7)) {
            return false;
        }
        else if ($browser->getPlatform() == Browser::PLATFORM_BLACKBERRY) {
            return false;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 35)) {
            return false;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_OPERA && $browser->getVersion() <= 13)) {
            return false;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 30)) {
            return false;
        }
        //GUI does not work out in Android 3 or later
        else if (($browser->getBrowser() == Browser::BROWSER_ANDROID && $browser->getVersion() < 4)) {
            return false;
        }
        else {
            return true;
        }
    }
}
