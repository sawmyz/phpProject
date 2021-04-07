<?php

namespace FwMigrationSystem\Resources;
use Str;

if (!class_exists('FwMigrationSystem\Resources\TableName')) {
    class TableName extends Str {
        public function __construct(string $string) {
            $string = "tbl$string";
            parent::__construct($string);
        }
    }
}
