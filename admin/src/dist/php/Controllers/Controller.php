<?php

use DATABASE\Model;
use FwBase\Reports\ReportScheme;
use fwJson\Json;

abstract class Controller {
    public $model = null;
    protected $key = null;
    private $request_type = 'external';
    private $output;
    private $key_value;
    private $requestArray = array();
    private $controller_type = null;

    public function __construct(Model $ModelInstance = null) {
        $this->conn = FwConnection::conn();
        if (null == $this::name) {
            throw new ControllerException('Constant "name" must be specified');
        }
        if ($this instanceof ReportScheme) {
            $this->setModel();
        } else {
            if ($this instanceof ControllerScheme) {
                if ($ModelInstance !== null and $ModelInstance instanceof Model) {
                    $this->setModel($ModelInstance);
                    $this->setKey($ModelInstance->_key);
                } else {
                    $className = (str_replace('controller', 'model', get_class($this)));

                    if (class_exists($className)) {
                        $model = new $className($this->conn);
                        if ($model instanceof Model) {
                            $this->setModel($model);
                            $this->setKey($model->_key);
                        }
                    }
                }
            }
        }
        if (isset($_REQUEST[$this->key()])) {
            $this->setKeyValue($_REQUEST[$this->key()]);
        }
        $this->setRequestArray($_REQUEST);
    }

    /**
     * @param Model|null $model
     */
    protected function setModel(?Model $model = null): void {
        $this->model = $model;
    }

    /**
     * @param string $key
     */
    protected function setKey($key): void {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function Key(): string {
        return $this->key;
    }

    private function setKeyValue($key) {
        $this->key_value = $key;
    }

    public function setRequestArray($requestArray, bool $unsetControllerType = true) {
        if ($unsetControllerType) {
            if (isset($requestArray['controller_type'])) {
                $this->setControllerType($requestArray['controller_type']);
                unset($requestArray['controller_type']);
            }
        }
        $this->requestArray = $requestArray;
    }

    /**
     * @param null $controller_type
     */
    protected function setControllerType($controller_type) {
        $this->controller_type = $controller_type;
    }

    public static function ControllerList() {
        $output = [];
        $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/'));
        $phpFiles = new RegexIterator($allFiles, '/\.php$/');
        foreach ($phpFiles as $phpFile) {
            $class = getClassFromFile($phpFile->getRealPath());
            $class = "\controller\\$class";
            $object = new stdClass();
            $object->class = str_replace('\controller', '', $class);
            $object->name = $class::name;
            $output[] = $object;
        }
        return $output;
    }

    public function __toString() {
        return '\\' . $this->class();
    }

    public function class() {
        return get_class($this);
    }

    public function __call($name, $arguments) {
    	
        if ($name == 'isApi') {
            echo Json::encode(['status' => 'failed', 'message' => 'this controller is not an api', 'helper' => 'you should use the "ApiInterface" trait in order to make this class an Api!']);
            die();
        } elseif (str($name)->startsWith('fwPagination_')){
        	header("Content-Type application/json");
        	echo json_encode([
        		'isOk' => false,
	        ]);
        }
    }

    public function RelPath(array $params = []) {
        $list = (sizeof($params) > 0 ? '?' : '');
        foreach ($params as $param => $value) {
            $list .= "$param=$value&";
        }
        $list = (sizeof($params) > 0 ? substr($list, 0, strlen($list) - 1) : '');
        return str_replace('"', '', str_replace('controllers/', '', $this->SoftPath()) . $list);
    }

    public function SoftPath(string $php = '', bool $dots = true) {
        try {
            $reflector = new ReflectionClass(get_class($this));
            if ($dots) return '"' . str_replace('.php', '', str_replace(__SOURCE__, '', $reflector->getFileName())) . '' . $php . '"';
            return str_replace('.php', '', str_replace(__SOURCE__, '', $reflector->getFileName())) . $php;
        } catch (ReflectionException $e) {
            return $e;
        }
    }

    public function model(): Model {
        return $this->model;
    }

    public function do(string $controller_type = '') {
        $this->loadView();
        global $NoOUTPUT_INCLUDE;
        if ($NoOUTPUT_INCLUDE === true) {
            return null;
        }
        if (strlen($controller_type) > 0) $_REQUEST['controller_type'] = $controller_type;
        if (isset($_REQUEST['controller_type']) and strlen($_REQUEST['controller_type']) > 0) {
            if (method_exists($this, $_REQUEST['controller_type'])) {
                $args = (get_method_argNames(get_class($this), $_REQUEST['controller_type']));
                $params = [];
                foreach ($args as $arg) {
                    $params[$arg] = isset($_REQUEST[$arg]) ? $_REQUEST[$arg] : null;
                }
                $this->setOutput(call_user_func_array(array($this, $_REQUEST['controller_type']), $params));
            } else {
                throw new ControllerException('Method "' . $_REQUEST['controller_type'] . '" not found in class!');
            }
        } else {
            $this->setOutput($this->main());
        }
        $this->castOutput();
    }

    public function loadView() {
    	if (!class_exists($this->viewName())) {
			include str_replace('.php', '.view.php', str_replace('controllers', 'views', $this->Path()));
		}
    }

    public function Path() {
        try {
            $reflector = new ReflectionClass(get_class($this));
            return $reflector->getFileName();
        } catch (ReflectionException $e) {
            return $e;
        }
    }

    /**
     * @param null $output
     */
    private function setOutput($output) {
        $this->output = $output;
    }

    public function castOutput() {
        echo $this->output;
    }

    public function Api($controller_type = '', string $version = '')
    {
        if (strlen($controller_type) > 0)
            $_REQUEST['controller_type'] = $controller_type;
        if ($version !='')
            $version = "_$version";
        if (isset($_REQUEST['controller_type']) and strlen($_REQUEST['controller_type']) > 0) {
            $_REQUEST['controller_type'] = $_REQUEST['controller_type'] . $version;
            if (method_exists($this, $_REQUEST['controller_type'])) {
                $args = (get_method_argNames(get_class($this), $_REQUEST['controller_type']));
                $params = [];
                foreach ($args as $arg) {
                    $params[$arg] = isset($_REQUEST[$arg]) ? $_REQUEST[$arg] : null;
                }
				$res = call_user_func_array(array($this, $_REQUEST['controller_type']), $params);
                if (isset($res)) {
                    $this->setOutput(json_encode([
                        'isDone' => true,
                        'requestedMethod' => $_REQUEST['controller_type'],
                        'data' => (($res instanceof Json) ? $res->Decode() : $res)
                    ]));
                } else {
					$this->setOutput(json_encode([
                        'isDone' => false,
                        'requestedMethod' => $_REQUEST['controller_type'],
                        'data' => [
                            'message' => 'failed_during_method_call'
                        ]
                    ]));
                }
            } else {
                throw new ControllerException('Method "' . $_REQUEST['controller_type'] . '" not found in class!');
            }
        } else {

            $this->setOutput($this->{'All'.$version}());
        }
        $this->castOutput();
    }


    /**
     * @return mixed
     */
    protected function key_value() {
        return $this->key_value;
    }

    protected function requestArray() {
        return $this->requestArray;
    }

    protected function viewName() {
        return "\\view\\" . str_replace('controller\\', '', $this->class());
    }

    protected function view($className, $method, $params) {
        $Instance = new $className($this, $params[0]);
        if ($Instance instanceof View) $res = $Instance->Process($method);

        $allFiles = [];
        $views = [];
        $controllers = [];
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/')), '/\.php$/') as $phpFile) {
            $fileName = $phpFile->getFileName();
            $views[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
            $allFiles[] = (true ? str_replace('.php', '', $fileName) : $fileName);
        }
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
            $controllers[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
        }

        $html = $res;
        $script = '<script>
                ' . (true ? '$(document).ajaxStart(function () {
                    Pace.restart();
                });
                $.Ajax(' . json_encode($allFiles) . ', ' . json_encode($views) . ', ' . json_encode($controllers) . ')' : '') . '
                ' . (true ? '$("[data-toggle=tooltip]").tooltip();
                $(".tooltip").hide();' : '') . '
                ' . (true ? '$.checkSelect();' : '') . '
                 ' . (true ? '$.checkIcon();' : '') . '
                 ' . (true ? '$.fw_tags();' : '') . '
                 ' . (true ? '$.checkCheckBox();' : '') . '
                 ' . ($Instance->initDataTable ? '$.table(true);' : '') . '

               </script>';
        return  $html.$script;
    }

    /**
     * @return null
     */
    private function getControllerType() {
        return $this->controller_type;
    }

    /**
     * @return string
     */
    private function getRequestType(): string {
        return $this->request_type;
    }
}
