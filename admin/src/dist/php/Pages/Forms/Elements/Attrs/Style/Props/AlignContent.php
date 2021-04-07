<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class AlignContent extends Props {
    const name = 'align-content';
    public static $value;

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Stretch(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Center(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Flex_start(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Flex_end(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Space_between(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Space_around(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Initial(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return AlignContent
     * @throws \ReflectionException
     */
    public static function Inherit(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
}
