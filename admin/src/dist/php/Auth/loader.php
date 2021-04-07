<?php
$AddressToIncludeAuthSystem = __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Auth/';
include $AddressToIncludeAuthSystem.'Utils/AuthenticationException.php';
include $AddressToIncludeAuthSystem.'Utils/AuthConfig.php';
include $AddressToIncludeAuthSystem.'Utils/AuthMiddleware.php';
include $AddressToIncludeAuthSystem.'Utils/AuthRole.php';
include $AddressToIncludeAuthSystem.'UserObject.php';
include $AddressToIncludeAuthSystem.'Auth.php';
