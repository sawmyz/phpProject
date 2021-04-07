<?php

namespace FwRoutingSystem\Router;

use FwRoutingSystem\Middleware;

class RouterCommand
{
    /**
     * @var RouterCommand|null Class instance variable
     */
    protected static $instance = null;

    protected $baseFolder;
    protected $paths;
    protected $namespaces;

    /**
     * RouterCommand constructor.
     *
     * @param $baseFolder
     * @param $paths
     * @param $namespaces
     */
    public function __construct($baseFolder, $paths, $namespaces)
    {
        $this->baseFolder = $baseFolder;
        $this->paths = $paths;
        $this->namespaces = $namespaces;
    }

    /**
     * @param $baseFolder
     * @param $paths
     * @param $namespaces
     *
     * @return RouterCommand|static
     */
    public static function getInstance($baseFolder, $paths, $namespaces)
    {
        if (null === self::$instance) {
            self::$instance = new static($baseFolder, $paths, $namespaces);
        }
        return self::$instance;
    }

    public function getMiddlewareInfo()
    {
        return [
            'path' => $this->baseFolder . '/' . $this->paths['middlewares'],
            'namespace' => $this->namespaces['middlewares'],
        ];
    }

    /**
     * Run Route Middlewares
     *
     * @param $command
     *
     * @return mixed|void
     * @throws
     */
    public function beforeAfter($command)
    {
        if (!is_null($command)) {
            if (!is_array($command)) {
                $cmd = $command;
                $command = [];
                $command[] = $cmd;
            }
            foreach ($command as $item) {
                if ($item instanceof Middleware) {
                    return $item->handle();
                } else {
                    $this->exception('MiddleWares should always implement the Middleware class!');
                }
            }
        }

        return;
    }

    /**
     * Throw new Exception for Router Error
     *
     * @param $message
     *
     * @return RouterException
     * @throws
     */
    public function exception($message = '')
    {
        return new RouterException($message);
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @param $command
     * @param $params
     *
     * @return mixed|void
     * @throws
     */
    public function runRoute($command, $params = null)
    {
        $info = $this->getControllerInfo();
        if (!is_object($command)) {
            $segments = explode('@', $command);
            $controllerClass = str_replace([$info['namespace'], '\\', '.'], ['', '/', '/'], $segments[0]);
            $controllerMethod = $segments[1];
            $controller = $this->resolveClass($controllerClass, $info['path'], $info['namespace']);
            if (method_exists($controller, $controllerMethod)) {
                echo $this->runMethodWithParams([$controller, $controllerMethod], $params);
                return;
            }

            return $this->exception($controllerMethod . ' method is not found in ' . $controllerClass . ' class.');
        } else {
            echo $this->runMethodWithParams($command, $params);
        }

        return;
    }

    public function getControllerInfo()
    {
        return [
            'path' => $this->baseFolder . '/' . $this->paths['controllers'],
            'namespace' => $this->namespaces['controllers'],
        ];
    }

    /**
     * Resolve Controller or Middleware class.
     *
     * @param $class
     * @param $path
     * @param $namespace
     *
     * @return object
     * @throws
     */
    protected function resolveClass($class, $path, $namespace)
    {
        $class = "\\$namespace$class";
        return (new $class());
    }

    /**
     * @param $function
     * @param $params
     *
     * @return mixed
     */
    protected function runMethodWithParams($function, $params)
    {
        return call_user_func_array($function, (!is_null($params) ? $params : []));
    }
}
