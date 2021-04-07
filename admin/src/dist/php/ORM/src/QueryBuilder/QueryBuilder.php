<?php


namespace DATABASE\ORM\QueryBuilder\QueryBuilder;

use DATABASE\Model;
use DATABASE\ORM\QueryBuilder\DBCollection;
use FwConnection;
use Generator;
use PDO;
use stdClass;
use Str;

/**
 * @property array where_clause
 */
trait QueryBuilder {
    /**
     * @var string
     */
    private $___table;
    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var string
     */
    private $query_string = '';
    /**
     * @var array
     */
    private $__where_clause = [];

    private $__type = 'select';
    private $__order_by = '';
    private $__offset = '';
    private $__limit = '';
    private $__groupBy = '';
    private $__having = '';


    /**
     * @var array
     */
    private $methods = [];


    private $___entity = stdClass::class;

    /**
     * DB constructor.
     */
    final public function __start() {
        if ($this instanceof Model or $this instanceof Db) {
            $this->___table = $this->_table;
        }
        if ($this->_Entity !== null) {
            $this->___entity = new $this->_Entity();
        }
        $this->conn = FwConnection::$conn;
    }


    public function __set($name, $value) {
        if ($name == 'where_clause' and is_array($value)) {
            $this->methods[] = 'where';
            $this->__where_clause[] = $value;
        }
    }

    /**
     * Retrieving All Rows From A Table
     */
    public function get(): DBCollection {


        return DBCollection::create($this->_get());
    }

    private function _get() {

        if ($this->query_string == '') {
            $this->query_string = "SELECT * FROM `{$this->___table}` ";
        } elseif (strpos($this->query_string, 'select') === false) {
            $this->query_string = " SELECT * FROM `{$this->___table}` {$this->query_string}";
        }
        if (sizeof($this->__where_clause) > 0) {
            $conditions = $this->___genWhere();
            $this->query_string .= " $conditions";
        }
	    if (strlen($this->__order_by) > 5){
		    $this->query_string .= " {$this->__order_by}";
	    }
	    if (strlen($this->__limit) > 4){
		    $this->query_string .= " {$this->__limit}";
	    }
	    if (strlen($this->__offset) > 4){
		    $this->query_string .= " {$this->__offset}";
	    }
	    if (strlen($this->__having) > 4){
		    $this->query_string .= " {$this->__having}";
	    }
	    if (strlen($this->__groupBy) > 4){
		    $this->query_string .= " {$this->__groupBy}";
	    }
        return $this->__run();
    }
	
	public function rowCount() : int {
		$res = $this->conn->prepare("SELECT * FROM `$this->_table`");
		$res->execute();
		return $res->rowCount();
    }
    private function ___genWhere() {
        $i = 0;
        $conditions = '';
        foreach ($this->__where_clause as $item) {
            $i++;
            if ($i == 1) $item['type'] = ' where ';

            $conditions .= " {$item['type']} {$item['string']}";
        }
        return $conditions;
    }

    /**
     * @return Generator
     */
    private function __run() {

//        echo "<kbd>".$this->query_string.'</kbd><br>';
        $res = $this->conn->prepare($this->query_string);
        $res->execute();
        if ($this->___entity instanceof stdClass){
            while ($row = $res->fetchObject()) {
                yield $row;
            }
        } else {
            while ($row = $res->fetchObject(get_class($this->___entity))) {
                yield $row;
            }
        }
    }

    public function __call($name, $arguments) {
        $Str = new Str($name);
        switch ($name) {
            case $Str->includes('where_'):
                $Str->replace('where_', '');
                switch ($Str) {
                    case $Str->includes('Is'):
                        switch ($arguments[0]) {
                            case is_array($arguments[0]):
                                $this->_whereIn($Str->replace('Is', ''), $arguments[0]);
                                break;
                            default:
                                $this->_whereEquals($Str->replace('Is', ''), $arguments[0]);
                                break;
                        }
                        break;
                    case $Str->includes('IsNot'):
                        switch ($arguments[0]) {
                            case is_array($arguments[0]):
                                $this->_whereIn($Str->replace('IsNot', ''), $arguments[0]);
                                break;
                            default:
                                $this->whereNotIn($Str->replace('IsNot', ''), $arguments[0]);
                                break;
                        }
                        break;
                    case $Str->includes('Like'):
                        $this->whereLike($Str->replace('Like', $arguments[0]));
                        break;
                }

        }
        return $this;
    }

    /**
     * @param string $column
     * @param array $arrayOfValues
     * @param string $operator
     */
    private function _whereIn(string $column, array $arrayOfValues, string $operator = 'in') {
        $arrayOfValues = "( " . implode(',', $arrayOfValues) . ' )';
        $this->where_clause = ['type' => 'and', 'string' => " `$column` $operator $arrayOfValues"];
    }

    /**
     * @param string $func_get_arg
     * @param string $func_get_arg1
     */
    private function _whereEquals(string $func_get_arg, string $func_get_arg1) {
        $this->_whereOperator($func_get_arg, '=', $func_get_arg1);
    }

    /**
     * @param $func_get_arg
     * @param string $func_get_arg1
     * @param $func_get_arg2
     */
    private function _whereOperator($func_get_arg, string $func_get_arg1, $func_get_arg2) {
		$func_get_arg2 = ($func_get_arg2 === null ? "NULL" : "'$func_get_arg2'");
        $this->where_clause = ['type' => 'and', 'string' => " `$func_get_arg` $func_get_arg1 $func_get_arg2"];
    }

    /**
     * @param string $column
     * @param array $arrayOfValues
     * @return $this
     */
    public function whereNotIn(string $column, array $arrayOfValues) {
        $this->_whereIn($column, $arrayOfValues, ' not in ');
        return $this;
    }

    public function whereLike() {
        foreach (func_get_args() as $index => $arg) {
            if (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    $this->_whereOperator($key, 'like', $value);
                }
            } else {
                $this->_whereOperator($index, 'like', $arg);
            }
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function where() {
        $args = func_get_args();
        switch (sizeof($args)) {
            case 1:
                if (is_array($args[0])) {
                    foreach ($args[0] as $key => $value) {
                        $this->_whereEquals($key, $value);
                    }
                } elseif (is_string($args[0])){
                    $this->where_clause = ['type' => 'and', 'string' => " {$args[0]} "];
                }
                break;
            case 2:
                $this->_whereEquals(func_get_arg(0), func_get_arg(1));
                break;
            case 3:
                $this->_whereOperator(func_get_arg(0), func_get_arg(1), func_get_arg(2));
                break;
			default:
				foreach (array_chunk($args,3) as $item) {
					call_user_func_array([$this,'where'],$item);
				}
				break;
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function orWhere() {
        $args = func_get_args();
        switch (sizeof($args)) {
            case 1:
                if (is_array($args[0])) {
                    foreach ($args[0] as $key => $value) {
                        $this->_orWhereEquals($key, $value);
                    }
                }
                break;
            case 2:
                $this->_orWhereEquals(func_get_arg(0), func_get_arg(1));
                break;
            case 3:
                $this->_whereOperator(func_get_arg(0), func_get_arg(1), func_get_arg(2));
                break;
        }
        return $this;
    }

    /**
     * @param string $func_get_arg
     * @param string $func_get_arg1
     */
    private function _orWhereEquals(string $func_get_arg, string $func_get_arg1) {
        $this->_orWhereOperator($func_get_arg, '=', $func_get_arg1);
    }

    /**
     * @param $func_get_arg
     * @param string $func_get_arg1
     * @param $func_get_arg2
     */
    private function _orWhereOperator($func_get_arg, string $func_get_arg1, $func_get_arg2) {
        $this->where_clause = ['type' => 'or', 'string' => " `$func_get_arg` $func_get_arg1 '$func_get_arg2'"];
    }

    /**
     * @param string $column
     * @param int $min
     * @param int $max
     * @return $this
     */
    public function whereBetween(string $column, int $min, int $max) {
        $this->_whereRange($column, $min, $max, 'between');
        return $this;
    }

    /**
     * @param string $column
     * @param int $min
     * @param int $max
     * @param string $string
     */
    private function _whereRange(string $column, int $min, int $max, string $string) {
        $condition = '1 = 1';
        if ($string == 'between') {
            $condition = "`$column` >= $min and `$column` <= $max";
        } elseif ($string == 'not_between') {
            $condition = "`$column` <= $min or `$column` >= $max";
        }
        $this->where_clause = ['type' => 'and', 'string' => " $condition"];
    }

    /**
     * @param string $column
     * @param int $min
     * @param int $max
     * @return $this
     */
    public function whereNotBetween(string $column, int $min, int $max) {
        $this->_whereRange($column, $min, $max, 'not_between');
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset) {
        $this->__offset .= " OFFSET $offset";
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit) {
        $this->__limit = " limit $limit";
        return $this;
    }

    /**
     * @param string $column
     * @param bool $desc
     * @return $this
     */
    public function orderBy(string $column = '', bool $desc = false) {
        $desc = $desc ? "DESC" : '';
        $column = ($column != '' ? "`$column`" : 'RAND()');
        $this->__order_by = " ORDER BY $column $desc";
        return $this;
    }

    /**
     * @param string $column
     * @return $this
     */
    public function groupBy(string $column) {
        $this->__groupBy = " GROUP BY `$column`";
        return $this;
    }

    /**
     * @param string $column
     * @param string $operator
     * @param $value
     * @return $this
     */
    public function having(string $column, string $operator, $value) {
        $this->__having = " HAVING `$column` $operator $value";
        return $this;
    }

    /**
     * @param string $column
     * @param array $arrayOfValues
     * @return $this
     */
    public function whereIn(string $column, array $arrayOfValues) {
        if (sizeof($arrayOfValues) <= 1){
            $this->_whereEquals($column,"$arrayOfValues[0]");
        } else {
            $this->_whereIn($column, $arrayOfValues, ' in ');
        }
        return $this;
    }

    /**
     * @return DBCollection
     */
    public function lists() {
        return DBCollection::create($this->_lists(func_get_args()));
    }

    /**
     * @param array $args
     * @return Generator
     */
    private function _lists(array $args) {
        $columns = [];
        foreach ($args as $arg) {
            $columns[] = $arg;
        }
        $columns = implode(',', $columns);
        if ($this->query_string == '') $this->query_string = "SELECT `$columns` FROM `{$this->___table}`";
        foreach ($this->__run() as $row) {
            $output = [];
            foreach ($args as $column) {
                $output[] = $row->{$column};
            }
            yield $output;
        }
    }

    public function insert(array $colsAndValue) {
        switch (CountDimensions($colsAndValue)) {
            case 1:
                list($fields, $values) = $this->_insert($colsAndValue);
                $this->query_string = "INSERT INTO `{$this->___table}` ($fields) VALUES ($values)";
                return $this->__runBool();
            case 2:
                $i = 0;
                foreach ($colsAndValue as $item) {
                    list($fields, $values) = $this->_insert($item);
                    $this->query_string = "INSERT INTO `{$this->___table}` ($fields) VALUES ($values)";
                    if ($this->__runBool()) {
                        $i++;
                    }
                }
                return $i;
        }
    }

    private function _insert(array $info) {
        $fields = "";
        $values = "";
        foreach ($info as $key => $value) {
            $value = str_replace('\\', '\\\\', $value);
            $fields .= " `$key`,";
            $values .= "'$value',";
        }
        $fields = substr($fields, 0, strlen($fields) - 1);
        $values = substr($values, 0, strlen($values) - 1);
        return [$fields, $values];
    }

    /**
     * @return bool
     */
    private function __runBool() {
        $res = $this->conn->prepare($this->query_string);
        $res->execute();
        return $res->errorInfo()[0] === '00000';
    }

    public function update(array $array) {
        $this->query_string = "UPDATE `{$this->___table}` SET {$this->_update($array)} {$this->___genWhere()}";
        $this->__type = 'update';
//        echo $this->showQuery();
        return $this->__runBool();
    }

    private function _update(array $array) {
        $fields = "";
        foreach ($array as $field => $value) {
            $value = str_replace('\\', '\\\\', $value);
            $fields .= " `$field` = '$value' ,";
        }
        return substr($fields, 0, strlen($fields) - 1);
    }

    public function showQuery() {
        if ($this->__type == 'select') {
            $this->_get();
        }
        return "<kbd>{$this->query_string}</kbd>";
    }

    /**
     * @param array $colsAndValue
     * @return int
     */
    public function insertWithId(array $colsAndValue): int {
        list($fields, $values) = $this->_insert($colsAndValue);
        $this->query_string = "INSERT INTO `{$this->___table}` ($fields) VALUES ($values)";
//        echo $this->query_string;
        if ($this->__runBool()) {
            return (int)$this->conn->lastInsertId();
        } else {
            return 0;
        }
    }

    public function delete() {
        $this->query_string = "DELETE FROM `{$this->___table}` {$this->___genWhere()}";
        $this->__type = 'delete';
        return $this->__runBool();
    }

    private function lastMethod() {
        return $this->methods[sizeof($this->methods) - 1];
    }

}
