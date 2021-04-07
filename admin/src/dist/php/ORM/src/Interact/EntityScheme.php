<?php

namespace DATABASE\ORM\Interact\Entities;

use stdClass;
use ArrayAccess;
use DATABASE\Model;
use DATABASE\ORM\QueryBuilder\QueryBuilder\Db;
use FwCollection\src\BaseCollection;
use fwJson\Json;
use PDOStatement;
use ReflectionException;
use ReflectionProperty;

if (!class_exists('DATABASE\ORM\Interact\Entities\EntityScheme')) {
	abstract class EntityScheme extends BaseEntity implements ArrayAccess {
		private $isConstructed;
		
		/**
		 * @param bool $byDict
		 *
		 * @return array
		 */
		public function toArray(bool $byDict = false) : array {
			$output = [];
			try {
				if (!$byDict) {
					foreach (get_object_vars($this) as $var => $value) {
						$Reflect = new ReflectionProperty($this, $var);
						if ($Reflect->isPublic()) {
							$output[$var] = $value;
						}
					}
				} else {
					foreach (get_object_vars($this) as $var => $value) {
						$Reflect = new ReflectionProperty($this, $var);
						if ($Reflect->isPublic()) {
							if ($this->dictionary()[$var]) {
								$var = $this->dictionary()[$var];
							}
							$output[$var] = $value;
						}
					}
				}
			} catch(ReflectionException $exception) {
			
			}
			return $output;
		}
		
		/**
		 * @param bool $byDict
		 *
		 * @return stdClass
		 */
		public function toObject(bool $byDict = false) : stdClass {
			return (object)($this->toArray($byDict));
		}
		
		/**
		 * @return Model
		 */
		abstract public function model();
		
		
		/**
		 * EntityScheme constructor.
		 */
		public function __construct() {
			$this->isConstructed = !(debug_backtrace()[1]['object'] instanceof PDOStatement);
		}
		
		/**
		 * @param int $options
		 *
		 * @return Json
		 */
		public function toJson($options = 0) : Json {
			return Json::encode(get_object_vars($this));
		}
		
		/**
		 * @return array|mixed
		 */
		public function jsonSerialize() {
			return get_object_vars($this);
		}
		
		/**
		 * @param string $jsonString
		 *
		 * @return BaseCollection|static
		 */
		public static function fromJson(string $jsonString) {
			$decode = json_decode($jsonString, true);
			return static::fromArray($decode);
		}
		
		/**
		 * @param $name
		 * @param $value
		 */
		public function __set($name, $value) {
			if ($name != '') {
				$dict = $this->dictionary();
				$key = array_search($name, $dict);
				$this->{$key} = $value;
			}
		}
		
		public function __get($name) {
			if ($name != '') {
				$dict = $this->dictionary();
				$key = array_search($name, $dict);
				return $this->{$key};
			}
		}
		
		/**
		 * @return array
		 */
		protected function dictionary() : array {
			$output = [];
			$vars = get_object_vars($this);
			foreach ($vars as $var => $value) {
				$output[$var] = $var;
			}
			return $output;
		}
		
		/**
		 * @param array $array
		 *
		 * @return BaseCollection|static
		 */
		static function fromArray(array $array) {
			switch (CountDimensions($array)) {
				case 1:
					$instance = new static();
					foreach ($array as $key => $value) {
						$instance->$key = $value;
					}
					return $instance;
				case 2:
					$output = [];
					foreach ($array as $item) {
						$instance = new static();
						foreach ($item as $key => $value) {
							$instance->$key = $value;
						}
						$output[] = $instance;
					}
					return collect($output);
			}
			return new static();
		}
		
		public function __debugInfo() {
			return $this->toArray();
		}
		
		/**
		 * @return bool|int
		 */
		public function save() {
			$res = Db::tableFromEntity($this->model()->_table, $this);
			if ($this->isConstructed) {
				$id = $res->insertWithId($this->toArray(true));
				$this->{array_search($this->model()->_key, $this->dictionary())} = $id;
				return $id;
			}
			return $res->where($this->model()->_key, $this->{array_search($this->model()->_key, $this->dictionary())})->update($this->toArray(true));
		}
		
		/**
		 * @return bool
		 */
		public function delete() {
			$res = Db::tableFromEntity($this->model()->_table, $this);
			return $res->where($this->model()->_key, $this->{array_search($this->model()->_key, $this->dictionary())})->delete();
		}
		
		
		/**
		 * Whether a offset exists
		 *
		 * @link https://php.net/manual/en/arrayaccess.offsetexists.php
		 *
		 * @param mixed $offset <p>
		 * An offset to check for.
		 * </p>
		 *
		 * @return bool true on success or false on failure.
		 * </p>
		 * <p>
		 * The return value will be casted to boolean if non-boolean was returned.
		 */
		public function offsetExists($offset) {
			return property_exists($this, $offset);
		}
		
		/**
		 * Offset to retrieve
		 *
		 * @link https://php.net/manual/en/arrayaccess.offsetget.php
		 *
		 * @param mixed $offset <p>
		 * The offset to retrieve.
		 * </p>
		 *
		 * @return mixed Can return all value types.
		 */
		public function offsetGet($offset) {
			return $this->{$offset};
		}
		
		/**
		 * Offset to set
		 *
		 * @link https://php.net/manual/en/arrayaccess.offsetset.php
		 *
		 * @param mixed $offset <p>
		 * The offset to assign the value to.
		 * </p>
		 * @param mixed $value <p>
		 * The value to set.
		 * </p>
		 *
		 * @return void
		 */
		public function offsetSet($offset, $value) {
			$this->__set($offset, $value);
		}
		
		/**
		 * Offset to unset
		 *
		 * @link https://php.net/manual/en/arrayaccess.offsetunset.php
		 *
		 * @param mixed $offset <p>
		 * The offset to unset.
		 * </p>
		 *
		 * @return void
		 */
		public function offsetUnset($offset) {
			$this->{$offset} = NULL;
			unset($this->{$offset});
		}
	}
}
