<?php
namespace FwHtml\Bs4\Helpers;
if (!class_exists('FwHtml\Bs4\Helpers\BsClasses')) {
    class BsClasses
    {
        private $class_name;
        public function __construct(string $class_name = ''){
            $this->class_name = $class_name;
        }
        public function __toString() {
            $className = end(explode('\\',get_class($this)));
            $className = str_replace('Class','',$className);
            $className = strtolower($className);
            if ($this->class_name != '') {
                return "$className-{$this->class_name}";
            } else {
                return $className;
            }
        }
        public static function self(){
            return new static();
        }
    }
}