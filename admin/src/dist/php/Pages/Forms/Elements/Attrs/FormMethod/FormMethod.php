<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;
use ReflectionException;

class FormMethod extends Props {
    const name = 'method';
    public static $value;

    /**
     * @return FormMethod
     * @throws ReflectionException
     */
    public static function Get(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }

    /**
     * @return FormMethod
     * @throws ReflectionException
     */
    public static function Post(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }
}
