<?php

namespace Api;

use fwJson\Json;

trait ApiInterface
{
    final public function isApi(){
        return true;
    }
    public function Find($primaryKey): Json
    {
        if ($res = $this->model()->get($primaryKey)) {
            return Json::encode([
                'status' => 'ok',
                'data' => $res
            ]);
        } else {
            return Json::encode([
                'status' => 'not_found'
            ]);
        }
    }

    public function All(): Json
    {
        return Json::encode($this->model()->getAll());
    }

    public function Remove($primaryKey): Json
    {
        if ($this->model()->delete($primaryKey)) {
            return Json::encode(['status' => 'ok', 'removed' => $primaryKey]);
        } else {
            return Json::encode(['status' => 'not_found', 'removed' => $primaryKey]);
        }
    }

    public function success(string $message = 'action_done_successfully',$data = []) {
        return [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
    }
    public function error(string $message = 'action_failed',$data = []) {
        return [
            'status' => false,
            'message' => $message,
            'data' => $data
        ];
    }

    public function ApiParam(string $name,bool $required = true) {

        if (isset($_POST[$name]) || isset($_GET[$name])){
            return isset($_POST[$name]) ? trim($_POST[$name]) : trim( $_GET[$name]);
        } elseif ($required) {
            echo json_encode(['isDone' => false, 'requestedMethod' => debug_backtrace()[1]['function'], 'message' => "'$name' is not an optional parameter"]);
            exit();
        }
    }
}
