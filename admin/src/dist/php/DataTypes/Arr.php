<?php

final class Arr {
    private $value = array();

    public function __construct(array $value) {
        $this->setValue($value);
    }

    public function __debugInfo() {
        return array("arr" => $this->getValue());
    }

    public function foreach(Closure $Callback) {
        foreach ($this->getValue() as $index => $value) {
            call_user_func_array($Callback, array($value, $index));
        }
    }

    public function __get($name) {
        if ($this->getValue()[$name]) {
            return $this->getValue()[$name];
        } else {
            return null;
        }
    }

    public function __isset($name) {
        var_dump($name);
    }

    public function __set($name, $n) {
        $arr = $this->getValue();
        $arr[$name] = $n;
        $this->setValue($arr);
        return $this;
    }

    public function diff(array $array2, $silent = true) {
        $res = array_diff($this->getValue(), $array2);
        if (!$silent) {
            $this->setValue($res);
            return $this;
        }
        return $res;
    }
    public function push($value, $silent = false) {
        $val = $this->value;
        array_push($val, $value);
        if (!$silent) $this->setValue($val);
        return $this;
    }

    public function len() {
        return sizeof($this->getValue());
    }

    public function pop() {
        return array_pop($this->value);
    }

    public function last() {
        return end($this->value);
    }

    public function lastKey() {
        $i = 0;
        foreach ($this->getValue() as $key => $item) {
            $i++;
            if ($this->len() == $i) {
                return $key;
            }
        }
    }

    public function firstKey() {
        $i = 0;
        foreach ($this->getValue() as $key => $item) {
            $i++;
            if (1 == $i) {
                return $key;
            }
        }
    }

    public function nthKey(int $index) {
        $i = 0;
        foreach ($this->getValue() as $key => $item) {
            if ($index == $i) {
                return $key;
            }
            $i++;
        }
    }

    public function first() {
        return $this->getValue()[0];
    }

    public function nth(int $len) {
        return $this->getValue()[$len];
    }

    /**
     * @return array
     */
    private function getValue(): array {
        return $this->value;
    }

    /**
     * @param array $value
     */
    private function setValue(array $value) {
        foreach ($value as $index => $item){
            if (!($item instanceof Str) and is_string($item)){
                $value[$index] = new Str($item);
            }
            $this->$index = $item;
        }
        $this->value = $value;
    }

    public function reverse(bool $silent = false) {
        $res = array_reverse($this->getValue());
        if (!$silent) {
            $this->setValue($res);
            return $this;
        }
        return $res;
    }
}
