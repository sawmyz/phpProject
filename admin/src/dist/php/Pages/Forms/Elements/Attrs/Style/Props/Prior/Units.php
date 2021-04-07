<?php
namespace FwHtml\Elements\Attrs\Style\Props;
if (!trait_exists('FwHtml\Elements\Attrs\Style\Props\CssUnits')) {
    trait CssUnits {
        public static function Em(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        public static function Px(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        public static function Vh(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        public static function Vw(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }
    }
}
