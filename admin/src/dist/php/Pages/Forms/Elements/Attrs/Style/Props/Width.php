<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class Width extends Props {
    use CssUnits;
    const name = 'width';
    public static $value;

    /**
     * @return Width
     * @throws \ReflectionException
     */
    public static function Auto(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
