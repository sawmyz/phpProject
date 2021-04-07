<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class CssFloat extends Props {
    const name = 'float';
    public static $value;

    /**
     * @return CssFloat
     * @throws \ReflectionException
     */
    public static function None(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return CssFloat
     * @throws \ReflectionException
     */
    public static function Right(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return CssFloat
     * @throws \ReflectionException
     */
    public static function Left(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return CssFloat
     * @throws \ReflectionException
     */
    public static function Initial(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return CssFloat
     * @throws \ReflectionException
     */
    public static function Inherit(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
