<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class MarginLeft extends Props {
    use CssUnits;
    const name = 'margin-left';
    public static $value;

    /**
     * @return MarginLeft
     * @throws \ReflectionException
     */
    public static function Auto(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
