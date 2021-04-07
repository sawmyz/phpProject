<?php

namespace fwJson\factory;

use ControllerScheme;
use fwJson\Json;
use fwJson\JsonException;
use PDOStatement;

trait JsonHelper {
    private $JSON_DATA = null;

    /**
     * @return Json
     */

    final public function JSON(): Json {
        return $this->JSON_DATA;
    }

    final public function seeJSONDATA() {
        var_dump($this->JSON_DATA);
    }

    /**
     * @param Json $JSON_DATA
     * @throws JsonException
     */
    final public function setJSON_DATA(Json $JSON_DATA) {
        if ($this instanceof ControllerScheme) {
            $this->JSON_DATA = $JSON_DATA;
        } else {
            throw new JsonException('Controller must be of type controller scheme');
        }
    }

    final protected function addFromJson(Json $json = null) {
        if ($json === null and $this->JSON_DATA === null) {
            throw new JsonException('You have no json data to start with!');
        } else {
            $json = null !== $json ? $json : $this->JSON_DATA;
        }
        $array = [];
        foreach ($json->iritate() as $key => $value) {
            if (is_object($value) or is_array($value)) {
                throw new JsonException("Values can not be of type array or object when using 'from json'");
            }
            $array[$key] = $value;
        }
        if (sizeof($array) > 0) {
            return $this->model()->add(checkAll($array));
        } else {
            throw new JsonException('Size of the json value was smaller than one and hence it could not be used to insert into database');
        }
    }

    final protected function editFromJson(Json $json = null) {
        if ($json === null and $this->JSON_DATA === null) {
            throw new JsonException('You have no json data to start with!');
        } else {
            $json = null !== $json ? $json : $this->JSON_DATA;
        }
        $array = [];
        $id = '';
        foreach ($json->iritate() as $key => $value) {
            if (is_object($value) or is_array($value)) {
                throw new JsonException("Values can not be of type array or object when using 'from json'");
            }
            if ($key == $this->key() and strlen($value) > 0) {
                $id = $value;
            }
            $array[$key] = $value;
        }
        if (sizeof($array) > 0) {
            if ($id != '') throw new JsonException('Primary key is not set');
            return $this->model()->edit($id, checkAll($array));
        } else {
            throw new JsonException('Size of the json value was smaller than one and hence it could not be used to insert into database');
        }
    }

    final protected function toJson($Method) {
        if (is_json($Method)) {
            return $Method;
        } else {
            if ($Method instanceof PDOStatement) {
                if ($Method) {
                    return new Json(json_encode(['status' => 'success']));
                } else {
                    return new Json(json_encode(['status' => 'failed']));
                }
            }
            if (is_object($Method) or is_array($Method)) {
                return new Json(json_encode($Method));
            } else {
                return new Json(json_encode(['message' => $Method, 'type' => gettype($Method)]));
            }
        }
        return new Json(($this->model()->getAll()));
    }
}
