<?php

namespace DATABASE\ORM\QueryBuilder;

use FwCollection\src\BaseCollection;
use Generator;

if (!class_exists('DATABASE\ORM\QueryBuilder\DBCollection')) {
    class DBCollection extends BaseCollection {


        public static function create(Generator $generator) {
            $array = [];
            foreach ($generator as $key => $value) {
                $array[$key] = $value;
            }
            return new self($array);
        }

        public function pluck(string $column) {
            $output = [];
            foreach ($this->all() as $value) {
                if (is_object($value) and $value instanceof \stdClass){
                    foreach ($value as $key => $item){
                        if ($key == $column) {
                            $output[] = $item;
                        }
                    }
                }
            }
            return new self($output);
        }



	}
}
