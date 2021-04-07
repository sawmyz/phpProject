<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class MarginBottom extends Props {
    use CssUnits;
    const name = 'margin-bottom';
    public static $value;

    /**
     * @return MarginBottom
     * @throws \ReflectionException
     */
    public static function Auto(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
