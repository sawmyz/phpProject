<?
namespace FwHtml\Bs4\TwoSyllableClasses;
use FwHtml\Bs4\Helpers\BsClasses;
use ReflectionMethod;
use FwHtml\Bs4\Helpers\BsColors;
if (!class_exists('FwHtml\Bs4\TwoSyllableClasses\ContainerClass')){
    final class ContainerClass extends BsClasses {
        final public static function Fluid(){
            return new self(str_replace(' ', '_', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

    }
}