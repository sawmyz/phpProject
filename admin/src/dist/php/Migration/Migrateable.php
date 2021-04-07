<?php
namespace FwMigrationSystem\Main;
if (!class_exists('FwMigrationSystem\Main\Migratable')){
    abstract class Migratable {
        abstract public function create_table();
        abstract public function drop_table();
    }
}
