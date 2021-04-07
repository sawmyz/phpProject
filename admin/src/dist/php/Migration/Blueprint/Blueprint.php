<?php

namespace FwMigrationSystem\Resources;

use FwMigrationSystem\ErrorHandling\MigrationException;
use FwMigrationSystem\Resources\Helpers\Types;
use Str;

if (!class_exists('FwMigrationSystem\Resources\Blueprint')) {
    class Blueprint {
        private $table_name;
        private $primary_key;
        private $cols = array();
        private $query_string = 'CREATE TABLE ';
        public function __debugInfo() {
            return array("table_name" => $this->getTableName());
        }

        public function __construct(TableName $table_name) {
            $this->setTableName($table_name);
            $this->setQueryString($this->getQueryString() . ' ' . $table_name . ' (');
        }

        public function primary_key(string $string = 'default_id_for_fw_migration_system') {
            if ($this->getTableName() == '') {
                throw new MigrationException('Table Name can\'t be empty');
            }
            $string = new Str($string);
            if ($string == 'default_id_for_fw_migration_system') {
                $tableName = ($this->getTableName());
                $tableName = $tableName->replace('tbl', '')->__toString();
                $tableNameArray = str_split($tableName);
                $newArray = [];
                foreach ($tableNameArray as $index => $value) {
                    if (preg_match('~^\p{Lu}~u', $value)) {
                        $value = strtolower($value);
                        $newArray[] = "_$value";
                    } else {
                        $newArray[] = $value;
                    }
                }
                $id = substr(implode('', $newArray),1,strlen(implode('', $newArray)) - 2);
                $this->setPrimaryKey($id);
            } else {
                $this->setPrimaryKey($string);
            }
            $this->setQueryString($this->getQueryString() . ' ' . $this->getPrimaryKey() . ' INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,');
        }

        public function showQuery() {
            $columns = $this->getCols();
            $cols = [];
            foreach ($columns as $column) {
                $nullable = $column->isNullable() ? " " : " NOT NULL ";
                $ai = ($column->getType() != 'TIMESTAMP' ? $column->isAutoIncrement() ? " AUTO_INCREMENT " : '' : '');
                $unique = ($column->getType() != 'TIMESTAMP' ? $column->isUnique() ? " UNIQUE " : '' : '');
                $def = $column->getDefault() ? " DEFAULT {$column->getDefault()}" : '';
                $length = ($column->getType() != 'TIMESTAMP' ? ($column->getLength() > 0 ? "({$column->getLength()})" : '') : '');
                $cols[] = "{$column->getColumnName()} {$column->getType()}$length $ai $nullable $def $unique";
            }
            $this->setQueryString($this->getQueryString() . ' ' . implode(', ', $cols) . ')');
            return "<p dir='ltr' style='direction: ltr'><kbd dir='ltr'>{$this->getQueryString()}</kbd></p>";
        }
        public function getQuery() {
            $columns = $this->getCols();
            $cols = [];
            foreach ($columns as $column) {
                $nullable = $column->isNullable() ? " " : " NOT NULL ";
                $ai = ($column->getType() != 'TIMESTAMP' ? $column->isAutoIncrement() ? " AUTO_INCREMENT " : '' : '');
                $unique = ($column->getType() != 'TIMESTAMP' ? $column->isUnique() ? " UNIQUE " : '' : '');
                $def = $column->getDefault() ? " DEFAULT {$column->getDefault()}" : '';
                $length = ($column->getType() != 'TIMESTAMP' ? ($column->getLength() > 0 ? "({$column->getLength()})" : '') : '');
                $cols[] = "{$column->getColumnName()} {$column->getType()}$length $ai $nullable $def $unique";
            }
            $this->setQueryString($this->getQueryString() . ' ' . implode(', ', $cols) . ')');
            return $this->getQueryString();
        }

        /**
         * @return mixed
         */
        private function getQueryString() {
            return $this->query_string;
        }

        /**
         * @param mixed $query_string
         */
        private function setQueryString($query_string) {
            $this->query_string = $query_string;
        }

        /**
         * @return mixed
         */
        private function getTableName() {
            return $this->table_name;
        }

        /**
         * @param mixed $table_name
         */
        private function setTableName($table_name) {
            $this->table_name = $table_name;
        }

        /**
         * @return mixed
         */
        private function getPrimaryKey() {
            return $this->primary_key;
        }

        /**
         * @param mixed $primary_key
         */
        private function setPrimaryKey($primary_key) {
            $this->primary_key = $primary_key;
        }

        public function VarChar(string $field_name) {
            return $this->addToCols(new Col($this->getTableName(), $field_name, 150, Types::VarChar));
        }

        public function Int(string $field_name) {
            return $this->addToCols(new Col($this->getTableName(), $field_name, 11, Types::Int));
        }
        public function Float(string $field_name) {
            return $this->addToCols(new Col($this->getTableName(), $field_name, 100, Types::Float));
        }
        public function Text(string $field_name) {
            return $this->addToCols(new Col($this->getTableName(), $field_name, -10, Types::Text));
        }
        public function TimeStamp(string $field_name) {
            return $this->addToCols(new Col($this->getTableName(), $field_name, -10, Types::TimeStamp));
        }
        private function addToCols(Col $col){
            try {
                return $this->ADDTOCOLUMNARRAY($col);
            } catch (MigrationException $e) {
                echo "<kbd>{$e->getMessage()}</kbd>";
            }
        }
        private function ADDTOCOLUMNARRAY(Col $col) {
            if (isset($this->cols[$col->getColumnName()]))
                throw new MigrationException('Duplicate Column name');
            $this->cols[$col->getColumnName()] = $col;
            return $col;
        }
        public function __toString() {
            $cols = [];
            foreach ($this->cols as $col_name => $col){
                $type_data = [
                    'isNullable' => $col->isNullable(),
                    'isAutoIncrement' => ($col->getType() != 'TIMESTAMP' ? $col->isAutoIncrement() ? true : false : false),
                    'isUnique' => ($col->getType() != 'TIMESTAMP' ? $col->isUnique() ? true : false : false),
                    'default' => $col->getDefault() ? $col->getDefault() : '',
                    'length' => ($col->getType() != 'TIMESTAMP' ? $col->getLength() : '-10')
                ];
                $cols[$col_name] = $type_data;
            }
            return json_encode($cols);
        }

        /**
         * @return array
         */
        private function getCols(): array {
            return $this->cols;
        }

        /**
         * @param array $cols
         */
        private function setCols(array $cols) {
            $this->cols = $cols;
        }


    }
}
