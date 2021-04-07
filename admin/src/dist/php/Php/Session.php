<?php
namespace FwPhp\Backend;
@session_start();
if (!class_exists('FwPhp\Backend\Session')) {

    final class Session {

        public static final function init(){
            return $_SESSION;
        }
        public static final function Auth() {
            return $_SESSION['auth'];
        }
        public static function __callStatic($name, $arguments)
        {
            return $_SESSION[$name];
        }
        public static final function set(string $name,$value){
            $_SESSION[$name] = $value;
        }
    }
}