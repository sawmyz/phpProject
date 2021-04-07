<?php
$reserves = ['lg', 'sm', 'md', 'xl'];
$colorss= ['danger', 'warning', 'success', 'primary','info','secondary','dark','light'];
$arr = cs_decode($str);
$classList = [];
foreach ($arr as $class) {
    $className = new Str($class);
    if ($className->includes('-')) {
        $array = $className->explode('-');
        $newClass = $array[0];
        if (sizeof($array) === 2 and !arrayHasSubStringFromArray($array,$reserves)) {
            $classList[$newClass][] = $array[1];
        }
    }
}
foreach ($classList as $className => $items) {
    $funcs = "";
    foreach ($items as $item) {
        $space = "\t\t";
        if (strlen($funcs) == 0) {
            $space = "";
        }

        $funcName = str_replace('.', '', $item);
        $funcName = trim($funcName);
        $funcName = str_replace(' ', '_', $funcName);
        if (is_numeric($funcName)){
            $num  = explode(' ',\helpers\numToWord::convert($funcName));
            $output = [];
            foreach ($num as $value){
                $value[0] = strtoupper($value[0]);
                $output[] = $value;
            }
            $output = implode('',$output);
            $output = str_replace('-','',$output);
            $funcs .= $space."final public static function $output(){
            return new self('$funcName');
        }\n";
        } else {
            if (!in_array($funcName, $colorss)) {
                $funcName[0] = strtoupper($funcName[0]);

                $funcs .= $space . "final public static function $funcName(){
            return new self(str_replace(' ', '_', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }\n";
            } elseif (strpos($funcs,'use BsColors;') === false) {
                $funcs = "use BsColors;\n".$funcs;
                $use = 'use FwHtml\Bs4\Helpers\BsColors;';
            }
        }
    }
    $funcs = new Str($funcs);
    $newClass = str_replace('.', '', $className);
    $newClass = trim($newClass);
    $newClass = str_replace(' ', '_', $newClass);
    $newClass[0] = strtoupper($newClass[0]);
    $newClass = "$newClass"."Class";
    $content = "<?
namespace FwHtml\Bs4\TwoSyllableClasses;
use FwHtml\Bs4\Helpers\BsClasses;
use ReflectionMethod;
$use
if (!class_exists('FwHtml\Bs4\TwoSyllableClasses\\$newClass')){
    final class $newClass extends BsClasses {
        $funcs
    }
}";
    $handler = fopen(__SOURCE__ . 'dist/php/Pages/Bootstrap/TwoSyllables/' . $newClass . '.php', 'w');
    fwrite($handler, $content);
    fclose($handler);
}