<?php

/**
 * Class Auth
 * Simply checks if user is logged in. In the app, several controllers use Auth::handleLogin() to
 * check if user if user is logged in, useful to show controllers/methods only to logged-in users.
 */
class URL
{
    public static function handle($URL)
    {
        if (isset($this->url_controller)) {
            $this->url_controller === $URL;
        }
    }
}
