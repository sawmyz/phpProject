<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;
class Target extends Props {
    const name = 'target';
    public static $value;

    /**
     * @return Target
     * @throws \ReflectionException
     */
    public static function _Blank(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }

    /**
     * @return Target
     * @throws \ReflectionException
     */
    public static function _Parent(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }

    /**
     * @return Target
     * @throws \ReflectionException
     */
    public static function _Self(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }

    /**
     * @return Target
     * @throws \ReflectionException
     */
    public static function _Top(){
        self::$value = strtolower(((new \ReflectionMethod(__METHOD__))->getShortName()));
        return new self();
    }
}
