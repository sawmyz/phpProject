<?php

use FwAuthSystem\Main\Auth;
use FwAuthSystem\Main\UserObject;
use FwRoutingSystem\Middleware;

class AuthMiddleware implements Middleware {

    public function handle($matched = null) {
        if (Auth::isLoggedIn() !== true) {
            if (!ob_get_clean()) {
                header('location: login');
            } else {
                echo "<script>location.replace('login')</script>";
            }
        }
    }
}
