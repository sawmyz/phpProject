<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class Margin extends Props {
    const name = 'margin';
    public static $value = '0em 0em 0em 0em';

    public static function Static(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
