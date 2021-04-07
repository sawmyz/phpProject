<?php

namespace fwJson;

use Closure;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Json implements \JsonSerializable {

    private $json_value;

    public function __construct($json) {

        $decoded = new \stdClass();
        if (is_object($json) or is_array($json)) {
            $json = jsonEncode($json);
        }
        if (is_json($json)) {
            $decoded = json_decode($json);
        }
        $this->json_value = $decoded;
    }

    public static function encode($getAll)
    {
        return new Json($getAll);
    }

    public function iritate() {
        foreach ($this->json_value as $key => $value){
            yield $key => $value;
        }
    }


    public function __set($name, $value) {
        $this->json_value->$name = $value;
    }

    public function __get($name) {
        return $this->json_value->$name;
    }

    public function __toString() {
        return json_encode($this->json_value, JSON_UNESCAPED_UNICODE);
    }

    public function __debugInfo() {
        return array("json" => $this->json_value);
    }

    public function jsonSerialize() {
        return $this->__toString();
    }

    public function Decode() {
        return $this->json_value;
    }
}
