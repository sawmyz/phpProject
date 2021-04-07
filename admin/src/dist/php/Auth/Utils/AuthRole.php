<?php
namespace FwAuthSystem\Utils;
use FwHtml\Elements\Tags\Main\HtmlTags;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

if (!class_exists('FwAuthSystem\Utils\AuthRole')){
    abstract class AuthRole {
            abstract public static function roleName() : string;
            abstract public static function accessList() : array;
            public static function All(){
                $output = [];
                foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
                    $output[] = "controller\\".getClassFromFile($phpFile->getRealPath());
                }
                return $output;
            }

        public static function optionList(string $selectRole = '') {
            $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید.")];
            foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'conf/Roles/')), '/\.php$/') as $phpFile) {
                $fileName = str_replace('.php','',$phpFile->getFileName());
                if ($fileName != 'AdminRole') {
					$className = "FwAuthSystem\Role\\$fileName";
					$output[] = HtmlTags::Option()
						->Value($fileName)
						->Content($className::roleName());
					if ($selectRole == $fileName) {
						end($output)->Selected();
					}
				}
            }
            return implode('',$output);
        }
    }
}
