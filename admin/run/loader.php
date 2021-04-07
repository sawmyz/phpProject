<?php
session_start();

define('__BASE_DIR__', substr(__DIR__, 0, strpos(__DIR__, 'run') - 1) . DIRECTORY_SEPARATOR);
include __BASE_DIR__.'src/autoload.php';
if (!isset($_SESSION['fw']['cli']['__DIR__'])) {
    $_SESSION['fw']['cli']['__DIR__'] = __BASE_DIR__;
    $_SESSION['fw']['cli']['dir'] = str_replace(__BASE_DIR__, '', $_SESSION['fw']['cli']['__DIR__']);
} else {
    $_SESSION['fw']['cli']['__DIR__'] = (endsWith($_SESSION['fw']['cli']['__DIR__'], '/') ? $_SESSION['fw']['cli']['__DIR__'] : $_SESSION['fw']['cli']['__DIR__'] . '/');
}
include 'dist/Cli.php';
include 'dist/UserCommand.php';
include 'dist/Commands.php';
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/User/')), '/\.php$/') as $phpFile) {
    include $phpFile->getRealPath();
}
