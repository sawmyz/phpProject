<?php

namespace FwCollection\src;

use ArrayAccess;
use Iterator;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use ReflectionException;
use ReflectionFunction;

class BaseCollection implements Iterator, ArrayAccess, \Countable, \JsonSerializable {
    /**
     * @var array
     */
    private $array;

    /**
     * BaseCollection constructor.
     * @param array $array
     */
    final public function __construct(array $array) {
        $this->array = $array;
    }

    /**
     * The map method iterates through the collection and passes each value to the given callback.
     * The callback is free to modify the item and return it, thus forming a new collection of modified items
     * @param callable $function
     * @return BaseCollection
     */
    public function map(callable $function): BaseCollection {
        $output = [];
        try {
            $Reflect = new ReflectionFunction($function);
            foreach ($this->array as $index => $item) {
                if (sizeof($Reflect->getParameters()) == 1) {
                    $res = $function($item);
                } elseif (sizeof($Reflect->getParameters()) == 2) {
                    $res = $function($item, $index);
                }
                if ($res) {
                    $output[$index] = $res;
                }
            }
        } catch (ReflectionException $exception) {
            echo "Error! in " . __LINE__ . ' file: ' . __FILE__ . ' class: ' . __CLASS__;
        }
        $this->array = $output;
        return $this;
    }

    public function length(): int {
        return sizeof($this->array);
    }

    /**
     * The reject method filters the collection using the given callback.
     * The callback should return true if the item should be removed from the resulting collection:
     * @param callable $function
     * @return $this
     */
    public function reject(callable $function): BaseCollection {
        try {
            $Reflect = new ReflectionFunction($function);
            foreach ($this->array as $index => $value) {
                if (sizeof($Reflect->getParameters()) == 1) {
                    if ($function($value) === true) {
                        unset($this->array[$index]);
                    }
                } elseif (sizeof($Reflect->getParameters()) == 2) {
                    if ($function($value, $index) === true) {
                        unset($this->array[$index]);
                    }
                }

            }

        } catch (ReflectionException $exception) {
            echo "Error! in " . __LINE__ . ' file: ' . __FILE__ . ' class: ' . __CLASS__;
        }
        return $this;
    }

    /**
     * The all method returns the underlying array represented by the collection:
     * @return array
     */
    public function all(): array {
        return $this->array;
    }

    /**
     * @return float
     */
    public function average(): float {
        return $this->avg();
    }

    /**
     * @return float
     */
    public function avg(): float {
        return round($this->sum($this->array) / sizeof($this->array));
    }

    private function sum(array $arr): int {
        $output = 0;
        foreach ($arr as $item) {
            if (is_numeric($item)) {
                $output += $item;
            } elseif (is_array($item)) {
                $output += $this->sum($item);
            }
        }
        return $output;
    }


    /**
     * The chunk method breaks the collection into multiple, smaller collections of a given size:
     * @param int $int
     * @return BaseCollection
     */
    public function chunk(int $int): BaseCollection {
        $output = [];
        $chunk = array_chunk($this->array,$int);
        foreach ($chunk as $value){
            $output[] = collect($value);
        }
        return collect($output);
    }

    /**
     * The collapse method collapses a collection of arrays into a single, flat collection:
     * @return BaseCollection
     */
    public function collapse(): BaseCollection {
        $output = [];
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($this->array));
        foreach ($it as $v) {
            $output[] = $v;
        }
        return collect($output);
    }

    /**
     * The combine method combines the values of the collection,
     * as keys, with the values of another array or collection:
     * @param array $array_of_values
     * @return BaseCollection
     */
    public function combine(array $array_of_values): BaseCollection {
        $output = [];
        $i = 0;
        foreach ($this->array as $value) {
            $output[$value] = $array_of_values[$i];
            $i++;
        }
        return collect($output);
    }

    /**
     * The collect method returns a new Collection instance with the items currently in the collection:
     * @return BaseCollection
     */
    public function collect(): BaseCollection {
        return collect($this->array);
    }

    /**
     * The sort method sorts the collection. The sorted collection keeps the original array keys,
     * so in this example we'll use the values method to reset the keys to consecutively numbered indexes:
     * @param bool $desc
     * @return BaseCollection
     */
    public function sort(bool $desc = false) {
        $output = $this->array;
        asort($output);
        if ($desc) $output = array_reverse($output);
        return collect($output);
    }

    /**
     * The sortBy method sorts the collection by the given key.
     * The sorted collection keeps the original array keys,
     * so in this example we'll use the values method to reset the keys to consecutively numbered indexes
     * You can also pass your own callback to determine how to sort the collection values
     * @param string|callable $sortBy
     * @param bool $desc
     * @return BaseCollection
     */
    public function sortBy($sortBy, bool $desc = false) {
        $output = $this->array;
        if (is_string($sortBy)) {
            usort($output, function ($a, $b) use ($sortBy) {
                return $a[$sortBy] <=> $b[$sortBy];
            });
        } elseif (is_callable($sortBy)) {
            usort($output, function ($a, $b) use ($sortBy) {
                return $sortBy($a) <=> $sortBy($b);
            });
        }
        if ($desc) $output = array_reverse($output);
        return collect($output);
    }

    /**
     * The get method returns the item at a given key. If the key does not exist, null is returned:
     *
     * You may even pass a callback as the default value.
     * The result of the callback will be returned if the specified key does not exist
     * depending on the count of expected parameters null,keyName, KeyName and collection will be passed to the callback
     * @param string $keyName
     * @param null $defaultValue
     * @return mixed
     */
    public function get(string $keyName, $defaultValue = null) {
        if (is_callable($defaultValue)) {
            if (isset($this->array[$keyName])) return $this->array[$keyName];
            try {
                $Reflect = new ReflectionFunction($defaultValue);
                if (sizeof($Reflect->getParameters()) == 0) {
                    return $defaultValue();
                } elseif (sizeof($Reflect->getParameters()) == 1) {
                    return $defaultValue($keyName);
                } elseif (sizeof($Reflect->getParameters()) == 2) {
                    return $defaultValue($keyName, $this);
                }
            } catch (ReflectionException $exception) {
                echo "Error! in " . __LINE__ . ' file: ' . __FILE__ . ' class: ' . __CLASS__;
            }

        }
        return (isset($this->array[$keyName]) ? $this->array[$keyName] : $defaultValue);
    }

    /**
     * The has method determines if a given key exists in the collection:
     * @param string|array $keyOrKeys
     * @return bool
     */
    public function has($keyOrKeys) {
        if (is_string($keyOrKeys)) {
            return isset($this->array[$keyOrKeys]);
        } elseif (is_array($keyOrKeys)) {
            foreach ($keyOrKeys as $key) {
                if (!$this->array[$key]) return false;
            }
        }
        return false;
    }

    /**
     * The isNotEmpty method returns true if the collection is not empty; otherwise, false is returned:
     * @return bool
     */
    public function isNotEmpty() {
        return !$this->isEmpty();
    }

    /**
     * The isEmpty method returns true if the collection is empty; otherwise, false is returned:
     * @return bool
     */
    public function isEmpty() {
        return empty($this->array);
    }

    public function __debugInfo() {
        return $this->array;
    }

    public function current() {
        return $this->array[$this->key()];
    }

    public function key() {

        return key($this->array);
    }

    public function next() {

        return next($this->array);
    }

    public function valid() {
        return isset($this->array[$this->key()]);
    }

    public function rewind() {
        reset($this->array);
    }

    /**
     * @return mixed
     */
    public function last() {
        return $this->array[sizeof($this->array) - 1];
    }

    public function first() {
        return $this->array[0];
    }

    public function offsetExists($offset) {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset) {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->array[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->array[$offset]);
    }

	public function count() {
		return sizeof($this->array);
	}

	public function jsonSerialize() {
		return $this->array;
	}
}
