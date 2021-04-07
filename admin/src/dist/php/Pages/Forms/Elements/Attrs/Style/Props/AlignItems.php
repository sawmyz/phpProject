<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class AlignItems extends Props {
    const name = 'align-items';
    public static $value;

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Stretch(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Center(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Flex_start(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Flex_end(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Baseline(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Initial(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignItems
     * @throws \ReflectionException
     */
    public static function Inherit(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
