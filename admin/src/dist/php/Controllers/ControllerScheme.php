<?php

use FwAuthSystem\Main\UserObject;
use FwHtml\Elements\Tags\Main\HtmlTags;
use fwJson\Json;
use helpers\action\Actions;

class ControllerScheme extends Controller
{
    const name = 'Controller';
    protected static $__uploads = [];
    protected static $__defaults = [];



    final public function __construct($ModelInstance = null)
    {
        try {
            parent::__construct($ModelInstance);
        } catch (ControllerException $e) {
            echo "<kbd>{$e->getMessage()}</kbd>";
        }
    }

    public function GetLabels(){
        return $this->view($this->viewName(),'labels',[
            []
        ]);
    }
    public function main()
    {
        return $this->view($this->viewName(), 'main', [
            $this->model()->getAll()
        ]);
    }
    public function editIndex($key = '0')
    {
        return $this->view($this->viewName(),'edit',[
            ($this->model()->get($key > 0 ? $key : cleanMe($this->key_value())))
        ]);
    }
    public function deleteIndex($key = '0')
    {
        return $this->view($this->viewName(),'delete',[
            ($this->model()->get($key > 0 ? $key : cleanMe($this->key_value())))
        ]);
    }
    public function viewIndex($key = '0')
    {
        return $this->view($this->viewName(),'view',[
            ($this->model()->get($key > 0 ? $key : cleanMe($this->key_value())))
        ]);
    }
    public function addIndex(){
        return $this->view($this->viewName(), 'add', [

        ]);
    }
    public function edit()
    {
        $array = $this->requestArray();
        foreach ((isset($this::$__defaults) ? $this::$__defaults : array()) as $key => $defaultValue) {
            if (!isset($array[$key])) {
                $array[$key] = $defaultValue;
                
            }
        }

        foreach ((isset($this::$__uploads) ? $this::$__uploads : array()) as $name => $path) {
            if (isset($_FILES[$name]) && strlen($_FILES[$name]['name']) > 0) {
                $deletable = (object)deStr($this->model()->get($this->key_value()));
                if ($deletable->$name !== 'default.png' || $deletable->$name !== 'default.jpg') {
                    if (file_exists($path . $deletable->$name) and !is_dir($path . $deletable->$name)) {
                        unlink($path . $deletable->$name);
                    }
                }
                $checkImage = checkImage($this->requestArray());
                if ($checkImage) {
                    $fileName = uploadImage($_FILES[$name], $checkImage, $path, true, $name);
                } else {
                    $fileName = uploadImage($_FILES[$name], $checkImage, $path, false, $name);
                }
                $array[$name] = $fileName;
            }
        }
	
	    $this->setRequestArray($array);
        $array = [];
        $array['data_before_action'] = json_encode($this->model()::get($this->key_value()),JSON_UNESCAPED_UNICODE);
        $array['data_after_action'] = json_encode(checkAll($this->requestArray(), true),JSON_UNESCAPED_UNICODE);
        $array['admin_id'] = UserObject::instance()->getUserId();
        $array['date'] = time();
        $array['action_type'] = 'edit';
        $array['row_id'] = $this->key_value();
        $array['tblName'] = $this->model()->_table;
        Actions::add($array);
        return (showResult($this->model()->edit($this->key_value(), checkAll($this->requestArray(), true)), $this::name, 'ویرایش'));
    }
    protected function add(?bool $csrf = true)
    {
        $csrf = ($csrf !== false);
        $array = $this->requestArray();
        foreach ((isset($this::$__defaults) ? $this::$__defaults : array()) as $key => $defaultValue) {
            if (!isset($array[$key])) {
                $array[$key] = $defaultValue;
            }
        }
        foreach ((isset($this::$__uploads) ? $this::$__uploads : array()) as $name => $path) {
            if (isset($_FILES[$name]['name']) and strlen($_FILES[$name]['name']) > 0) {
                $checkImage = checkImage($this->requestArray());
                if ($checkImage) {
                    $fileName = uploadImage($_FILES[$name], $checkImage, $path, true, $name);
                } else {
                    $fileName = uploadImage($_FILES[$name], $checkImage, $path, false, $name);
                }
                $array[$name] = $fileName;
            }
        }
        $this->setRequestArray($array);
        $id = $this->model()->add(checkAll($this->requestArray(),$csrf == true));
        if ($id > 0) {
            $array = [];
            $array['data_before_action'] = json_encode([]);
            $array['data_after_action'] = json_encode(checkAll($this->requestArray(),$csrf),JSON_UNESCAPED_UNICODE);
            $array['admin_id'] = UserObject::instance()->getUserId();
            $array['date'] = time();
            $array['action_type'] = 'add';
            $array['row_id'] = $id;
            $array['tblName'] = $this->model()->_table;
            Actions::add($array);
        }
        return (showResult($id > 0, $this::name, 'افزودن'));
    }

    public function addQuick() {
        $lastId = $this->model()::LastId();
        $this->add(false);
        $newId =  $this->model()::LastId();
        if ($newId > $lastId){
            $item = $this->model()::get($newId);
            return json_encode([
                'isDone' => true,
                'option' =>  HtmlTags::Option()->Selected()
                    ->Value($item->{$this->Key()})
                    ->Content($this->showInOption($item)),
                'id' => $newId
            ],JSON_UNESCAPED_UNICODE);
        }
        return json_encode(['isDone' => false]);
    }
    protected function delete()
    {
        $deletable = $this->model()->get($this->key());
        foreach ($this::$__uploads as $name => $path) {
            if ($deletable->$name !== 'default.png' || $deletable->$name !== 'default.jpg') {
                if (file_exists($path . $deletable->$name) and !is_dir($path . $deletable->$name)) {
                    unlink($path . $deletable->$name);
                }
            }
        }
        $array = [];
        $array['data_before_action'] = json_encode($this->model()::get($this->key_value()),JSON_UNESCAPED_UNICODE);
        $array['data_after_action'] = json_encode([]);
        $array['admin_id'] = UserObject::instance()->getUserId();
        $array['date'] = time();
        $array['action_type'] = 'delete';
        $array['row_id'] = $this->key_value();
        $array['tblName'] = $this->model()->_table;
        Actions::add($array);
        return showResult($this->model()->delete(cleanMe($this->key_value())), $this::name, 'حذف');
    }

    public function quickAdd() {
        $Instance = $this->ViewInstance();
        if ($Instance instanceof View){
            if (method_exists($Instance,'quickAddForm')){
                return $Instance->quickAddForm();
            } elseif (method_exists($Instance,'Form')){
                return $Instance->Form();
            }
        }
        return null;
    }

    public function ViewInstance() {

        if (!class_exists($this->viewName())) {
            $this->loadView();
        }
        $className = $this->viewName();
        $Instance = new $className($this);
        if ($Instance instanceof View){
            return $Instance;
        }
        return  null;
    }

    public function showInOption(object $item) : string {
        return '';
    }
    
}
