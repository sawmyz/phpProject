<?php

namespace FwAuthSystem\Main;

use Db;
use FwAuthSystem\Utils\AuthConfig;
use fwJson\Json;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

if (!class_exists('FwAuthSystem\Main\AuthenticationException')) {
    class Auth
    {
        private $config;
        private $doProccessOnSubmit = true;
        private static $conf;
        /**
         * @var bool
         */
        private $LoggedIn;
        private $User = null;

        public function __construct(AuthConfig $config)
        {
            $this->config = $config;
            $this::$conf = $config;
        }

        public static function init(AuthConfig $config)
        {
            return new self($config);
        }

        public static function end()
        {
            $_SESSION['auth']['isLoggedIn'] = false;
            $_SESSION['auth']['user'] = json_encode('Logged out');
        }

        public static function config()
        {
            if (self::$conf instanceof AuthConfig) {
                return self::$conf;
            }
        }

        public static function RoleList(){
            $output = [];
            foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'conf/Roles/')), '/.php$/') as $phpFile) {
                if (!class_exists("FwAuthSystem\Role\\".getClassFromFile($phpFile->getRealPath()))){
                    include $phpFile->getRealPath();
                    $output[end(explode('\\',end(get_declared_classes())))] = (end(get_declared_classes())::roleName());
                }
            }
            return $output;
        }
        public static function AllUsers(){
            $output = [];
            $conf = new AuthConfig();
            $res = \FwConnection::conn()->query("SELECT * FROM {$conf->_UsersTable}");
            while ($row = $res->fetchObject()){
                $output[] = $row;
            }
            return $output;
        }

        public function ProccessOnSubmit()
        {
            $this->doProccessOnSubmit = true;
            if (isset($_POST['submit'])) {
                $username = $_POST[$this::config()->__UserName];
                $password = $_POST[$this::config()->__Password];
                $password = sha1(md5($password));
                $Db = \DATABASE\ORM\QueryBuilder\QueryBuilder\Db::table($this::config()->_UsersTable);;
                $User = $Db->where($this::config()->__UserName,"$username")->get()->first();
                if (null !== $User) {
                    if ($User->{$this::config()->__Password} == $password) {
                        $this->LoggedIn = true;
                        $this->User = (([
                            $this::config()->__UserName => $User->{$this::config()->__UserName},
                            $this::config()->__Profile => $User->{$this::config()->__Profile},
                            $this::config()->__Name => $User->{$this::config()->__Name},
                            $this::config()->__Email => $User->{$this::config()->__Email},
                            $this::config()->_UsersTableId => $User->{$this::config()->_UsersTableId}
                        ]));
                        echo "<script>window.location.replace('index')</script>";
                    } else {
                        $this->LoggedIn = false;
                    }
                } else {
                    $this->LoggedIn = false;
                }
            }
        }

        public function __destruct()
        {
            if ($this->doProccessOnSubmit === true) {
                $hash = sha1(md5(json_encode($this->User(),JSON_UNESCAPED_UNICODE)));
                \FwConnection::conn()->query("UPDATE {$this::config()->_UsersTable}  SET `tmp_hash` = '{$hash}' WHERE `{$this::config()->__UserName}` = '{$this->User()[$this::config()->__UserName]}'");
                $_SESSION['auth']['isLoggedIn'] = $this->LoggedIn;
                $_SESSION['auth']['user'] = $hash;
            }
        }
        public static function isLoggedIn(){
            if (isset($_SESSION['auth'])  and is_array($_SESSION['auth'])) {
                if (isset($_SESSION['auth']['isLoggedIn'])) {
                    if ($_SESSION['auth']['isLoggedIn'] === true){
                        if (isset($_SESSION['auth']['user']) and $hash = $_SESSION['auth']['user']){
                            $conf = new AuthConfig();
                            if ($json = is_json(json_encode(\FwConnection::conn()->query("SELECT * FROM {$conf->_UsersTable} where tmp_hash = '{$hash}'")->fetchObject()),true,false)) {
                                return true;
                            } else {
                                return 'Wrong Hash';
                            }
                        } else {
                            return 'No User Set!';
                        }
                    } else {
                        return 'Logged Out';
                    }
                } else {
                    return 'Not initialized';
                }
            } else {
                return 'Not initialized From Base';
            }
        }

        private function User()
        {
            return $this->User;
        }

    }
}
