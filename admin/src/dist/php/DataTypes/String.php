<?php
if (!class_exists('Str')) {
    class Str implements JsonSerializable {
        private $value = '';

        /**
         * @param $name
         * @param $arguments
         * @return string
         */
        public function __call($name, $arguments) {
            return $this->getValue();
        }


        /**
         * @return string
         */
        public function __toString() {
            return $this->getValue();
        }

        /**
         * Str constructor.
         * @param string $string
         */
        public function __construct(string $string) {
            $this->setValue($string);
        }

        /**
         * @return Str
         */
        public function fistChar() {
            return new Str($this->getValue()[0]);
        }

        /**
         * @param bool $silent
         * @return Str
         */
        public function removeFirst(bool $silent = false) {
            if (!$silent) $this->setValue(substr($this->getValue(), 1, $this->len()));
            return new Str($this->getValue());
        }

        /**
         * @param bool $silent
         * @return Str
         */
        public function removeLast(bool $silent = false) {
            if (!$silent) $this->setValue(substr($this->getValue(), 0, $this->len() - 1));
            return new Str($this->getValue());
        }

        public function removeNth(int $pos, bool $silent = false) {
            if (!$silent) $this->setValue(substr($this->getValue(), 0, $pos) . substr($this->getValue(), $pos, $this->len()));
            return new Str($this->getValue());
        }

        public function includes(string $substr){
            return $this->pos($substr) !== false;
        }

        public function lastChar() {
            return new Str($this->getValue()[$this->len()]);
        }

        public function nthChar(int $pos) {
            return new Str($this->getValue()[$pos]);
        }

        public function endsWith($needle) {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }

            return (substr($this->getValue(), -$length) === $needle);
        }

        public function startsWith($needle) {
            $length = strlen($needle);
            return (substr($this->getValue(), 0, $length) === $needle);
        }

        /**
         * @param string $string
         * @return int
         */
        public function similar_text(string $string) {
            return similar_text($this->getValue(), $string);
        }

        /**
         * @return array
         */
        public function __debugInfo() {
            return array("str" => $this->getValue());
        }

        /**
         * @param $search
         * @param $replace
         * @param bool $silent
         * @return string
         */
        public function replace($search, $replace, bool $silent = false) {
            if (!$silent) $this->setValue(str_replace($search, $replace, $this->getValue()));
            return new Str(str_replace($search, $replace, $this->getValue()));
        }

        /**
         * @param string $delimiter
         * @return array
         */
        public function explode(string $delimiter = '') {
            return explode($delimiter, $this->getValue());
        }

        /**
         * @return string
         */
        public function soundex() {
            return soundex($this->getValue());
        }

        /**
         * @param string $search
         * @param string $resplace
         * @param bool $silent
         * @return string|string[]
         */
        public function ireplace(string $search, string $resplace, bool $silent = false) {
            if (!$silent) $this->setValue(str_ireplace($search, $resplace, $this->getValue()));
            return str_ireplace($search, $resplace, $this->getValue());
        }

        /**
         * @param int $length
         * @param string $pad_string
         * @param bool $silent
         * @return string
         */
        public function pad(int $length, string $pad_string = '.', bool $silent = false) {
            if (!$silent) $this->setValue(str_pad($this->getValue(), $length, $pad_string));
            return str_pad($this->getValue(), $length, $pad_string);
        }

        /**
         * @param int $multiplier
         * @param bool $silent
         * @return string
         */
        public function repeat(int $multiplier, bool $silent = true) {
            if (!$silent) $this->setValue(str_repeat($this->getValue(), $multiplier));
            return str_repeat($this->getValue(), $multiplier);
        }

        /**
         * @param bool $silent
         * @return string
         */
        public function shuffle(bool $silent = false) {
            if ($silent) $this->setValue(str_shuffle($this->getValue()));
            return str_shuffle($this->getValue());
        }

        /**
         * @return int|string[]
         */
        public function word_count() {
            return str_word_count($this->getValue());
        }

        /**
         * @param string $allow
         * @param bool $silent
         * @return string
         */
        public function strip_tags(string $allow = '', bool $silent = false) {
            if (!$silent) $this->setValue(strip_tags($this->getValue(), $allow));
            return strip_tags($this->getValue(), $allow);
        }

        /**
         * @param bool $silent
         * @return string
         */
        public function rev(bool $silent = true) {
            if (!$silent) $this->setValue(strrev($this->getValue()));
            return strrev($this->getValue());
        }

        /**
         * @param string $string
         * @return false|int
         */
        public function pos(string $string) {
            return strpos($this->getValue(), $string);
        }

        /**
         * @return string
         */
        public function Ucwords() {
            return ucwords($this->getValue());
        }

        /**
         * @param bool $silent
         * @return string
         */
        public function toUpper(bool $silent = false) {
            if (!$silent) $this->setValue(strtoupper($this->getValue()));
            return new Str(strtoupper($this->getValue()));
        }

        /**
         * @param bool $silent
         * @return string
         */
        public function toLower(bool $silent = false) {
            if (!$silent) $this->setValue(strtolower($this->getValue()));
            return new Str(strtolower($this->getValue()));
        }

        /**
         * @param string $string
         * @return int
         */
        public function cmp(string $string) {
            return strcmp($this->getValue(), $string);
        }

        /**
         * @param string $string
         * @return false|int
         */
        public function ipos(string $string) {
            return stripos($this->getValue(), $string);
        }

        /**
         * @param string $search
         * @param bool $before_search
         * @return false|string
         */
        public function istr(string $search, bool $before_search = false) {
            return stristr($this->getValue(), $search, $before_search);
        }

        /**
         * @param int $length
         * @return array
         */
        public function split(int $length = 1) {
            return str_split($this->getValue(), $length);
        }

        /**
         * @return int
         */
        public function len() {
            return strlen($this->getValue());
        }

        /**
         * @param string $string
         * @param bool $before_search
         * @return false|string
         */
        public function strstr(string $string, bool $before_search = false) {
            return stristr($this->getValue(), $string, $before_search);
        }

        /**
         * @param string $split
         * @param bool $silent
         * @return string
         */
        public function tok(string $split, bool $silent = false) {
            if (!$silent) $this->setValue(strtok($this->getValue(), $split));
            return strtok($this->getValue(), $split);
        }

        /**
         * @param string $charlist
         * @param bool $silent
         * @return string
         */
        public function trim(string $charlist = " \t\n\r \v", bool $silent = false) {
            if (!$silent) $this->setValue(trim($this->getValue(), $charlist));
            return new Str(trim($this->getValue(), $charlist));
        }

        /**
         * @param string $subString
         * @param int $start
         * @param int $length
         * @return int
         */
        public function substr_count(string $subString, int $start = 0, int $length = -1) {
            return substr_count($this->getValue(), $subString, $start, $length > 0 ? $length : $this->len());
        }

        /**
         * @return string
         */
        public function getValue(): string {
            return $this->value;
        }

        /**
         * @param string $value
         */
        private function setValue(string $value) {
            $this->value = $value;
        }

        /**
         * Specify data which should be serialized to JSON
         * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
         * @return mixed data which can be serialized by <b>json_encode</b>,
         * which is a value of any type other than a resource.
         * @since 5.4.0
         */
        public function jsonSerialize()
        {
            return $this->__toString();
        }
        public static function i(string $str){
            return new self($str);
        }

    }
    function str(string $string) : Str {
    	return new Str($string);
    }
}
