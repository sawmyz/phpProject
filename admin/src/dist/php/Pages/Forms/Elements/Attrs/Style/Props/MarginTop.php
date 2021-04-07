<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class MarginTop extends Props {
    use CssUnits;
    const name = 'margin-top';
    public static $value;

    /**
     * @return MarginTop
     * @throws \ReflectionException
     */
    public static function Auto(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
