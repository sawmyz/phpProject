<?php

namespace FwMigrationSystem\Resources;

use FwMigrationSystem\ErrorHandling\MigrationException;
use Str;

if (!class_exists('FwMigrationSystem\Resources\Col')) {
    class Col {
        private $table_name;
        private $column_name;
        private $length;
        private $default;
        private $type;
        private $unique = false;
        private $auto_increment = false;
        private $nullable = false;

        /**
         * Col constructor.
         * @param $table_name
         * @param $column_name
         * @param $length
         * @param $type
         */
        public function __construct($table_name, $column_name, $length, $type) {
            $this->table_name = $table_name;
            $this->column_name = $column_name;
            $this->length = $length;
            $this->setType($type);
        }

        public function Nullable() {
            $this->setNullable(true);
            return $this;
        }

        public function Len(int $length) {
            $this->length = $length;
            return $this;
        }

        public function AutoIncrement() {
            $this->setAutoIncrement(true);
            return $this;
        }

        public function Default(string $value) {
            $this->setDefault($value);
            return $this;
        }

        public function Unique() {
            $this->setUnique(true);
            return $this;
        }

        public function __debugInfo() {
            return array("column_name" => $this->column_name, "length" => $this->length, "nullable" => $this->isNullable(), "type" => $this->type);
        }

        /**
         * @return bool
         */
        public function isNullable(): bool {
            return $this->nullable;
        }

        /**
         * @param bool $nullable
         */
        private function setNullable(bool $nullable) {
            $this->nullable = $nullable;
        }

        /**
         * @return string
         */
        public function getType(): string {
            return $this->type;
        }

        /**
         * @param mixed $type
         */
        private function setType($type) {
            $this->type = $type;
        }

        /**
         * @return string
         */
        public function getColumnName(): string {
            return $this->column_name;
        }

        /**
         * @return int
         */
        public function getLength(): int {
            return $this->length;
        }

        /**
         * @return mixed
         */
        public function getDefault() {
            return $this->default;
        }

        /**
         * @return bool
         */
        public function isAutoIncrement(): bool {
            return $this->auto_increment;
        }

        /**
         * @param mixed $auto_increment
         */
        private function setAutoIncrement($auto_increment) {
            $this->auto_increment = $auto_increment;
        }

        /**
         * @param mixed $default
         */
        private function setDefault($default) {
            $this->default = $default;
        }

        /**
         * @return bool
         */
        public function isUnique(): bool {
            return $this->unique;
        }

        /**
         * @param bool $unique
         */
        private function setUnique(bool $unique) {
            $this->unique = $unique;
        }

        /**
         * @param mixed $length
         */
        private function setLength($length) {
            $this->length = $length;
        }

        /**
         * @param mixed $column_name
         */
        private function setColumnName($column_name) {
            $this->column_name = $column_name;
        }
    }
}
