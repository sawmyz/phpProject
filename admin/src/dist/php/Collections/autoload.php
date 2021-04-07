<?php
include __SOURCE__ . 'dist/php/Collections/src/BaseFunction.php';
spl_autoload_register(function ($name){
    if (strpos($name,'FwCollection') !== false){
        $last = explode('\\',$name);
        end($last);
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Collections/src/')), '/'.current($last).'/') as $phpFile) {
            include $phpFile->getRealPath();
        }
    }
});
