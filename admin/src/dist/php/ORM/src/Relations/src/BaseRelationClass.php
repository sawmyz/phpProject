<?php
namespace DATABASE\ORM\Relations\BaseClasses;
use DATABASE\ORM\Relations\RelationCondition\RelationCondition;

if (!class_exists('DATABASE\ORM\Relations\BaseTraits\BaseRelationClass')) {
    final class BaseRelationClass {
        private $type;
        private $table;
        private $as;
        private $conditions = [];
        /**
         * BaseRelationClass constructor.
         * @param $type
         * @param $table
         * @param $as
         */
        public function __construct($type,string $table,string $as) {
            $this->type = $type;
            $this->table = $table;
            $this->as = $as;
        }

        public function on() {
            switch (func_num_args()){
                case 3:
                    $one = func_get_arg(0);
                    $operation = func_get_arg(1);
                    $two = func_get_arg(2);
                    break;
                case 2:
                    $one = func_get_arg(0);
                    $operation = '=';
                    $two = func_get_arg(2);
                    break;
            }
            $this->conditions[] = new RelationCondition("$one $operation $two");
        }


    }
}
