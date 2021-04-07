<?
namespace FwHtml\Bs4\TwoSyllableClasses;
use FwHtml\Bs4\Helpers\BsClasses;
use ReflectionMethod;
use FwHtml\Bs4\Helpers\BsColors;
if (!class_exists('FwHtml\Bs4\TwoSyllableClasses\ColClass')){
    final class ColClass extends BsClasses {
        final public static function One(){
            return new self('1');
        }
		final public static function Ten(){
            return new self('10');
        }
		final public static function Eleven(){
            return new self('11');
        }
		final public static function Twelve(){
            return new self('12');
        }
		final public static function Two(){
            return new self('2');
        }
		final public static function Three(){
            return new self('3');
        }
		final public static function Four(){
            return new self('4');
        }
		final public static function Five(){
            return new self('5');
        }
		final public static function Six(){
            return new self('6');
        }
		final public static function Seven(){
            return new self('7');
        }
		final public static function Eight(){
            return new self('8');
        }
		final public static function Nine(){
            return new self('9');
        }
		final public static function Auto(){
            return new self(str_replace(' ', '_', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

    }
}