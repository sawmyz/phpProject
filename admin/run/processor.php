<?php
ini_set('display_errors',E_ALL);
session_start();
include 'loader.php';

use fwCli\dist\Cli;

$Cli = new Cli($_REQUEST['command']);
$Cli->addCommand(new fwCli\UserCommands\TestCommand());
