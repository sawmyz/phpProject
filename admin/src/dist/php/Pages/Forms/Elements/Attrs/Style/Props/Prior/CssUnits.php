<?php
namespace FwHtml\Elements\Attrs\Style\Props;
if (!trait_exists('FwHtml\Elements\Attrs\Style\Props\CssUnits')) {
    trait CssUnits {
        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Em(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Px(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Vh(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Vw(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Cm(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Mm(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function In(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Pt(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Pc(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Ex(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Ch(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Rem(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Vmin(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         * @throws \ReflectionException
         */
        public static function Vmax(int $value) {
            self::$value = $value . str_replace('_', '-', strtolower(((new \ReflectionMethod(__METHOD__))->getShortName())));
            return new self();
        }

        /**
         * @param int $value
         * @return CssUnits
         */
        public static function Percent(int $value) {
            self::$value = $value . '%';
            return new self();
        }
    }
}
