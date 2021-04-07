<?php


include __SOURCE__ . 'dist/php/Pages/Bootstrap/BsClasses.php';
include __SOURCE__ . 'dist/php/Pages/Bootstrap/BsColors.php';
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Pages/Bootstrap/TwoSyllables')),'/\.php$/') as $phpFile) {
    include $phpFile->getRealPath();
}
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Pages/Bootstrap/OneSyllables')),'/\.php$/') as $phpFile) {
    include $phpFile->getRealPath();
}
include __SOURCE__ . 'dist/php/Pages/Bootstrap/BS4.php';

