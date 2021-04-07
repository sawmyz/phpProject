<?php
if (!function_exists('csrf_field')){
    function csrf_field(string $formKey = ''){
        global $_SESSION;
        try {
            if (is_string($formKey)) {
                if (!isset($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = hash_hmac('sha256', $formKey, bin2hex(random_bytes(32)));
                } else {
                    $_SESSION['csrf_token'] = hash_hmac('sha256', $formKey, bin2hex(random_bytes(32)));
                }
                return '<input value="'.$_SESSION['csrf_token'].'" name="validations[csrf_token]" type="hidden">';
            } else {
                throw new Error('Form key must be string!');
            }
        } catch (Exception $e) {
            throw new Error($e);
        }
    }
}
if (!function_exists('csrf_validate')) {
    function csrf_validate(array $POST) {
        global $_SESSION;
        if (isset($_SESSION['csrf_token'])) {
            if (isset($POST['validations']) and isset($POST['validations']['csrf_token'])) {
                if (hash_equals(($POST['validations']['csrf_token']), $_SESSION['csrf_token'])) {
                    unset($POST['validations']);
                    return $POST;
                } else {
                    return false;
                }
            } else {
                throw new Error('csrf token not set in form!');
            }
        } else {
            throw new Error('csrf token not set in session!');
        }
    }
}
