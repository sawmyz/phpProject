<?php
namespace DATABASE\ORM\Relations\RelationCondition;
if (!class_exists('DATABASE\ORM\Relations\BaseTraits\RelationCondition')) {
    final class RelationCondition {
        private $string;

        /**
         * RelationCondition constructor.
         * @param $string
         */
        public function __construct($string) {
            $this->string = $string;
        }

        public function __toString() {
            return $this->string;
        }
    }
}
