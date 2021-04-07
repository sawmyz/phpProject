<?php
namespace DATABASE\ORM\Interact\Entities;
use DATABASE\Model;
use FwOrm\Utils\Deals\Convertables\Arrayable;
use FwOrm\Utils\Deals\Convertables\Jsonable;

if (!class_exists('DATABASE\ORM\Interact\Entities\BaseEntity')) {
    abstract class BaseEntity implements Arrayable, Jsonable,\JsonSerializable  {
        abstract static function fromJson(string $jsonString);
        abstract static function fromArray(array $array);
        abstract public function __set($name, $value);
        abstract protected function dictionary() : array;
        abstract public function save();
    }

}
