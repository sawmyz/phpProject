<?php
class Js {
    static function alert(string $alert){
        echo "<script>alert('$alert')</script>";
    }
    static function log(string $loggable){
        echo "<script>console.log('$loggable')</script>";
    }
}