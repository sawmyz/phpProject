<?php
namespace FwHtml\Elements\Attrs\Style\Props;
use FwHtml\Elements\Attrs\Props\Props;

class Display extends Props {
    const name = 'display';
    public static $value;

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function None(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Block(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Inline(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Flex(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Grid(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Inline_Block(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Table(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }
    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Inline_table(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Initial(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @return Display
     * @throws \ReflectionException
     */
    public static function Inherit(){
        self::$value = str_replace('_','-',strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
        return new self();
    }

    /**
     * @param $name
     * @param $arguments
     * @return Display
     */
    public static function __callStatic($name, $arguments) {
        if (sizeof($arguments) > 0){
            throw new \ArgumentCountError("Method $name cannot have any arguments!");
        } else {
            self::$value = str_replace('_','-',strtolower((($name))));
            return new self();
        }
    }
}
