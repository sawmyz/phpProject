<?php
/**
 * PHP library for handling exceptions and errors.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2018 (c) Josantonius - PHP-DataType
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-ErrorHandler
 * @since     1.0.0
 */
namespace Josantonius\ErrorHandler;

/**
 * Handling exceptions and errors.
 */
class ErrorHandler
{
    /**
     * Active stack.
     *
     * @var array
     */
    public static $stack;

    /**
     * Style load validator.
     *
     * @var bool
     */
    public static $styles = false;

    /**
     * Custom methods.
     *
     * @since 1.1.3
     *
     * @var bool
     */
    public static $customMethods = false;

    /**
     * Catch errors and exceptions and execute the method.
     */
    public function __construct()
    {
        set_exception_handler([$this, 'exception']);
        set_error_handler([$this, 'error']);
    }

    /**
     * Handle exceptions catch.
     *
     * Optionally for libraries used in Eliasis PHP Framework: $e->statusCode
     *
     * @param object $e
     *                  string $e->getMessage()       → exception message
     *                  int    $e->getCode()          → exception code
     *                  string $e->getFile()          → file
     *                  int    $e->getLine()          → line
     *                  string $e->getTraceAsString() → trace as string
     *                  int    $e->statusCode         → HTTP response status code
     */
    public function exception($e)
    {
        $traceString = preg_split("/#[\d]/", $e->getTraceAsString());

        unset($traceString[0]);
        array_pop($traceString);

        $trace = "\r\n<hr>BACKTRACE:\r\n";

        foreach ($traceString as $key => $value) {
            $trace .= "\n" . $key . ' ·' . $value;
        }

        $this->setParams(
            'Exception',
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $trace,
            (isset($e->statusCode)) ? $e->statusCode : 0
        );

        return $this->render();
    }

    /**
     * Handle error catch.
     *
     * @param int $code → error code
     * @param int $msg  → error message
     * @param int $file → error file
     * @param int $line → error line
     *
     * @return boolean
     */
    public function error($code, $msg, $file, $line)
    {
        $type = $this->getErrorType($code);

        $this->setParams($type, $code, $msg, $file, $line, '', 0);

        return $this->render();
    }

    /**
     * Convert error code to text.
     *
     * @param int $code → error code
     *
     * @return string → error type
     */
    public function getErrorType($code)
    {
        switch ($code) {
            case E_ERROR:
                return self::$stack['type'] = 'Error'; // 1
            case E_WARNING:
                return self::$stack['type'] = 'Warning'; // 2
            case E_PARSE:
                return self::$stack['type'] = 'Parse'; // 4
            case E_NOTICE:
                return self::$stack['type'] = 'Notice'; // 8
            case E_CORE_ERROR:
                return self::$stack['type'] = 'Core-Error'; // 16
            case E_CORE_WARNING:
                return self::$stack['type'] = 'Core Warning'; // 32
            case E_COMPILE_ERROR:
                return self::$stack['type'] = 'Compile Error'; // 64
            case E_COMPILE_WARNING:
                return self::$stack['type'] = 'Compile Warning'; // 128
            case E_USER_ERROR:
                return self::$stack['type'] = 'User Error'; // 256
            case E_USER_WARNING:
                return self::$stack['type'] = 'User Warning'; // 512
            case E_USER_NOTICE:
                return self::$stack['type'] = 'User Notice'; // 1024
            case E_STRICT:
                return self::$stack['type'] = 'Strict'; // 2048
            case E_RECOVERABLE_ERROR:
                return self::$stack['type'] = 'Recoverable Error'; // 4096
            case E_DEPRECATED:
                return self::$stack['type'] = 'Deprecated'; // 8192
            case E_USER_DEPRECATED:
                return self::$stack['type'] = 'User Deprecated'; // 16384
            default:
                return self::$stack['type'] = 'Error';
        }
    }

    /**
     * Set customs methods to renderizate.
     *
     * @since 1.1.3
     *
     * @param string|object $class   → class name or class object
     * @param string        $method  → method name
     * @param int           $repeat  → number of times to repeat method
     * @param bool          $default → show default view
     */
    public static function setCustomMethod($class, $method, $repeat = 0, $default = false)
    {
        self::$customMethods[] = [$class, $method, $repeat, $default];
    }

    /**
     * Handle error catch.
     *
     * @since 1.1.3
     *
     * @param int    $code  → exception/error code
     * @param int    $msg   → exception/error message
     * @param int    $file  → exception/error file
     * @param int    $line  → exception/error line
     * @param string $trace → exception/error trace
     * @param string $http  → HTTP response status code
     *
     * @return array → stack
     */
    protected function setParams($type, $code, $msg, $file, $line, $trace, $http)
    {
        return self::$stack = [
            'type' => $type,
            'message' => $msg,
            'file' => $file,
            'line' => $line,
            'code' => $code,
            'http-code' => ($http === 0) ? http_response_code() : $http,
            'trace' => $trace,
            'preview' => '',
        ];
    }

    /**
     * Get preview of the error line.
     *
     * @since 1.1.0
     */
    protected function getPreviewCode()
    {
        $file = file(self::$stack['file']);
        $line = self::$stack['line'];

        $start = ($line - 5 >= 0) ? $line - 5 : $line - 1;
        $end = ($line - 5 >= 0) ? $line + 4 : $line + 8;

        for ($i = $start; $i < $end; $i++) {
            if (! isset($file[$i])) {
                continue;
            }

            $text = trim($file[$i]);

            if ($i == $line - 1) {
                self::$stack['preview'] .=
                    "<span class='jst-line'>" . ($i + 1) . '</span>' .
                    "<span class='jst-mark text'>" . $text . '</span><br>';
                continue;
            }

            self::$stack['preview'] .=
                "<span class='jst-line'>" . ($i + 1) . '</span>' .
                "<span class='text'>" . $text . '</span><br>';
        }
    }

    /**
     * Get customs methods to renderizate.
     *
     * @since 1.1.3
     */
    protected function getCustomMethods()
    {
        $showDefaultView = true;
        $params = [self::$stack];

        unset($params[0]['trace'], $params[0]['preview']);

        $count = count(self::$customMethods);
        $customMethods = self::$customMethods;

        for ($i = 0; $i < $count; $i++) {
            $custom = $customMethods[$i];
            $class = isset($custom[0]) ? $custom[0] : false;
            $method = isset($custom[1]) ? $custom[1] : false;
            $repeat = $custom[2];
            $showDefault = $custom[3];

            if ($showDefault === false) {
                $showDefaultView = false;
            }

            if ($repeat === 0) {
                unset(self::$customMethods[$i]);
            } else {
                self::$customMethods[$i] = [$class, $method, $repeat--];
            }

            call_user_func_array([$class, $method], $params);
        }

        self::$customMethods = false;

        return $showDefaultView;
    }

    /**
     * Renderization.
     *
     * @return boolean
     */
    protected function render()
    {
        self::$stack['mode'] = defined('HHVM_VERSION') ? 'HHVM' : 'PHP';

        if (self::$customMethods && ! $this->getCustomMethods()) {
            return false;
        }

        $this->getPreviewCode();

        if (! self::$styles) {
            self::$styles = true;
            self::$stack['css'] = require __DIR__ . '/public/css/styles.html';
        }

        $stack = self::$stack;

        require __DIR__ . '/public/template/view.php';

        return true;
    }
}
