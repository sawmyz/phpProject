<?php

namespace DATABASE;


use FwOrm\Uses\Pagination\ModelPagination;
use DATABASE\ORM\Interact\Entities\EntityScheme;
use DATABASE\ORM\QueryBuilder\DBCollection;

use FwConnection;
use stdClass;

abstract class Model {
	public $_table;
	public $_key;
	public $_Entity;
	private $paginate;
	protected static $Controller;
	/**
	 * Model constructor.
	 */
	public function __construct() {
		if ($this->_table == null) {
			$this->_table = 'tbl' . collect(explode('\\', get_class($this)))->last();
		}
		if ($this->_Entity and class_exists($this->_Entity)) {
			$entity = new $this->_Entity();
			if ($entity instanceof EntityScheme) {
				$this->_Entity = $entity;
			}
		} else {
			$this->_Entity = new stdClass();
		}
		$this->onBoot();
	}

	public function onBoot() {
	}

	/**
	 * @return ORM\QueryBuilder\DBCollection
	 */
	public static function getAll() {
		$instance = static::instance();
		return ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity)->get();
	}

	/**
	 * @return static
	 */
	public static function instance() {
		return new static();
	}

	/**
	 * @return array
	 */
	public static function getAllActives() {
		$instance = static::instance();
		$table = $instance->_table;
		$key = $instance->_key;

		$res = FwConnection::conn()->query("select * from `tblActiveList` as actives left join $table as tbl on tbl.$key = actives.item_id where actives.table_name = '$table'");
		$output = [];
		while ($row = $res->fetchObject(get_class($instance->_Entity))) {
			$output[] = $row;
		}
		return $output;
	}

	public static function LastId() {
		$instance = static::instance();
		return ORM\QueryBuilder\QueryBuilder\Db::table($instance->_table)->orderBy($instance->_key, true)->limit(1)->get()->first()->{$instance->_key};
	}

	public static function GetLabelData($label) {
		$instance = static::instance();
		$form = $instance->_table;
		$form = 'add' . str_replace('tbl', '', $form);
		if (FwConnection::$conn->query("SELECT * FROM Labels where form = '$form' and label_text like '$label'")->rowCount() > 0) {
			return FwConnection::$conn->query("SELECT * FROM Labels where form = '$form' and label_text like '$label'")->fetchObject()->label_details;
		}
		return 'بدون شرح';
	}

	public static function Db() {
		$instance = static::instance();
		return ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
	}

	/**
	 * @param array|int|string $id
	 * @return bool
	 */
	public static function delete($id) {
		$id = is_array($id) ? $id : [$id];
		$instance = static::instance();
		return ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity)->whereIn($instance->_key, $id)->delete();
	}

	/**
	 * @param array $array
	 * @param string $operator
	 * @return EntityScheme|DBCollection|ORM\QueryBuilder\QueryBuilder\Db|stdClass
	 */
	public static function findOrCreate(array $array, string $operator = 'and') {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		if ($operator == 'and') {
			$res = $db->where($array);
		} elseif ($operator == 'or') {
			$res = $db->orWhere($array);
		}
		if (isset($res)) {
			if ($first = $res->get()->first()) {
				return $first;
			} else {
				if ($id = static::add($array)) {
					return static::get($id);
				}
			}
		}
		return null;
	}

	/**
	 * @param array $array
	 * @return bool|int
	 */
	public static function add(array $array) {
		$instance = static::instance();
		return ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity)->insertWithId($array);
	}

	public static function findOrNew(array $array) {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		$res = $db->where($array)->get()->first();
		if ($res) {
			return $res;
		}
		$entity = $instance->_Entity;

		foreach ($array as $key => $value) {
			$entity->$key = $value;
		}
		return $entity;
	}

	public static function getAllFiltered(string $filterField, $filterValue) {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		return $db->where($filterField, $filterValue)->get();
	}

	public static function getOneFiltered(string $filterField, $filterValue) {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		return $db->where($filterField, $filterValue)->get()->first();
	}

	public static function getAllConditioned(string $condition) {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		return $db->where($condition)->get();
	}

	public static function Rand() {
		$instance = static::instance();
		$db = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity);
		return $db->orderBy('RAND()')->get()->first();
	}



	/**
	 * @param array|int|string $id
	 * @param array $array
	 * @return EntityScheme|false|stdClass
	 */
	public static function edit($id, array $array) {
		$id = is_array($id) ? $id : [$id];
		$instance = static::instance();
		if (ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity)->whereIn($instance->_key, $id)->update($array)) {
			return static::get($id);
		}
		return false;
	}

	/**
	 * @param array|int|string $id
	 * @return stdClass|EntityScheme|DBCollection
	 */
	public static function get($id) {
		$id = is_array($id) ? $id : [$id];
		$instance = static::instance();
		$res = ORM\QueryBuilder\QueryBuilder\Db::tableFromEntity($instance->_table, $instance->_Entity)->whereIn("{$instance->_key}", $id);
//        echo $res->showQuery();
		$res = $res->get();
		if ($res->length() > 1) {
			return $res;
		}
		return $res->first();
	}

	/**
	 * @return false|string
	 */
	public function __toString() {
		return get_class($this);
	}
	
	final public function paginate() {
		if (!($this->paginate instanceof ModelPagination)){
			$this->paginate = new ModelPagination($this);
			if (!isset($_SESSION[$this::Controller()->class()]['pagination']['currentPage'])) $_SESSION[$this::Controller()->class()]['pagination']['currentPage'] = 0;
			if (!isset($_SESSION[$this::Controller()->class()]['pagination']['limit'])) $_SESSION[$this::Controller()->class()]['pagination']['limit'] = 9;
		}
		return $this->paginate;
	}
	
	public static function Controller() : \ControllerScheme {
		if (!(static::$Controller instanceof \ControllerScheme)){
			$name = '\controller\\'.collect(explode('\\', static::class))->last();
			static::$Controller = new $name();
		}
		
		return static::$Controller;
	}
}
