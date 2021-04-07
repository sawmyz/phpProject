<?php

namespace DATABASE\ORM\QueryBuilder\QueryBuilder;


final class Db {
    use QueryBuilder;

    /**
     * @var string
     */
    private $_table;
    private $_Entity = \stdClass::class;

    public function __construct(string $table_name,$_Entity = \stdClass::class) {
        $this->_table = $table_name;
        $this->_Entity = $_Entity;
        $this->__start();
    }

    public static function table(string $table_name) {
        return new self($table_name);
    }

    public static function tableFromEntity(string $_table, $_Entity) {
        return new self($_table,$_Entity);

    }

}
