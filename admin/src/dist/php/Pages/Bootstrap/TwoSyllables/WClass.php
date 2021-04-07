<?
namespace FwHtml\Bs4\TwoSyllableClasses;
use FwHtml\Bs4\Helpers\BsClasses;
use ReflectionMethod;
use FwHtml\Bs4\Helpers\BsColors;
if (!class_exists('FwHtml\Bs4\TwoSyllableClasses\WClass')){
    final class WClass extends BsClasses {
        final public static function OneHundred(){
            return new self('100');
        }
		final public static function Twentyfive(){
            return new self('25');
        }
		final public static function Fifty(){
            return new self('50');
        }
		final public static function Seventyfive(){
            return new self('75');
        }
		final public static function Auto(){
            return new self(str_replace(' ', '_', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

    }
}