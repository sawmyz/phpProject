<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class Position extends Props {
    const name = 'position';
    public static $value;

    public static function Static(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Absolute(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Fixed(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Relative(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Sticky(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Initial(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Position
     * @throws \ReflectionException
     */
    public static function Inherit(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
