<?php
if (!class_exists('Boolean')) {
    class Boolean implements JsonSerializable {
        protected $value;
        public function __construct(bool $bool) {
            $this->value = $bool;
        }

        public static function false(){
            return new self(false);
        }
        public static function true(){
            return new self(true);
        }
        public function isTrue(){
            return $this->value === true;
        }
        public function isFalse(){
            return $this->value === false;
        }
        public function __toString() {
            return ($this->isTrue() === false ? "false" : "true");
        }

        public function jsonSerialize() {
            return $this->__toString();
        }
    }
}
