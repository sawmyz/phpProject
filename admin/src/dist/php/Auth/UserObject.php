<?php

namespace FwAuthSystem\Main;

use Closure;
use Controller;
use FwAuthSystem\Utils\AuthConfig;
use FwConnection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use stdClass;

if (!class_exists('FwAuthSystem\Main\UserObject')) {
    final class UserObject
    {
        private $UserName = '';
        private $Profile = '';
        private $Name = '';
        private $Email = '';
        private $Id = '';
        private $Role = '';
        private $NameToKnow = '';

        public function __construct(string $UserName, string $Profile, string $Name, string $Email, string $Id, string $Role, string $NameToKnow)
        {
            $this->setId($Id);
            $this->setUserName($UserName);
            $this->setProfile($Profile);
            $this->setName($Name);
            $this->setEmail($Email);
            $this->setRole($Role);
            $this->setNameToKnow($NameToKnow);
            return $this;
        }

        public static function hasAccess(string $controllerClassName)
        {
            return self::__callStatic('canAccess', [new $controllerClassName, null])
                or self::__callStatic('canEdit', [new $controllerClassName, null])
                or self::__callStatic('canDelete', [new $controllerClassName, null])
                or self::__callStatic('canFilter', [new $controllerClassName, null])
                or self::__callStatic('canActivate', [new $controllerClassName, null]);
        }

        public static function canDelete(Controller $controller, stdClass $row = null)
        {
            return self::__callStatic('canDelete', [$controller]);
        }

        public static function canActivate(Controller $controller, stdClass $row = null)
        {
            return self::__callStatic('canActivate', [$controller, $row]);
        }

        public static function canEdit(Controller $controller, stdClass $row = null)
        {
            return self::__callStatic('canEdit', [$controller]);
        }

        public static function __callStatic($name, $arguments)
        {
            return true;

            if (strpos($name, 'can') !== false) {
                $controller = $arguments[0];
                $row = $arguments[1];
                $action = str_replace('can', '', end(explode('::', $name)));
                $action[0] = strtolower($action[0]);
                $roleName = self::instance()->Role;
                foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'conf/Roles/')), '/' . $roleName . '.php$/') as $phpFile) {
                    include $phpFile->getRealPath();
                }
                $controller = $controller->class();
                $className = "FwAuthSystem\Role\\$roleName";
                if (class_exists($className)) {
                    $array = $className::accessList();
                    if (in_array($controller, $array)) {
                        return true;
                    } else {
                        foreach ($array as $class => $arr) {
                            if ($class == $controller) {
                                if (is_array($arr)) {
                                    if (in_array($action, $arr)) {
                                        return true;
                                    } else {
                                        foreach ($arr as $act => $func) {
                                            if ($act == $action and $func instanceof Closure) {
                                                if ($func($row)) {
                                                    return true;
                                                }
                                            }
                                        }
                                    }
                                } elseif ($arr == $action) {
                                    return true;
                                }
                            }
                        }
                    }
                    return false;
                }
                return false;
            }
        }


        public static function instance()
        {
            $conf = new AuthConfig();
//            $json = is_json(json_encode(FwConnection::conn()->query("SELECT * FROM {$conf->_UsersTable} where tmp_hash = '09329dd401f65d54f90401225154bbc45bf8efcb'")->fetchObject()), true, false);
//            return self::fromJson($conf, $json);
            if (isset($_SESSION['auth']) and is_array($_SESSION['auth'])) {
                if (isset($_SESSION['auth']['isLoggedIn'])) {
                    if ($_SESSION['auth']['isLoggedIn'] === true) {
                        if (isset($_SESSION['auth']['user']) and $hash = $_SESSION['auth']['user']) {
                            $conf = new AuthConfig();
                            if ($json = is_json(json_encode(FwConnection::conn()->query("SELECT * FROM {$conf->_UsersTable} where tmp_hash = '{$hash}'")->fetchObject()), true, false)) {
                                            return self::fromJson($conf, $json);

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

        /**
         * @param AuthConfig $conf
         * @param stdClass $json
         * @return UserObject
         */
        public static function fromJson(AuthConfig $conf, stdClass $json)
        {
            return new self($json->{$conf->__UserName}, $json->{$conf->__Profile}, $json->{$conf->__Name}, $json->{$conf->__Profile}, $json->{$conf->_UsersTableId}, $json->{$conf->__Role}, $json->{$conf->__NameToKnow});
        }

        public static function RoleName()
        {
            if (($instance = self::instance()) instanceof UserObject) {
                return $instance->getRole();
            }
        }

        public function __debugInfo()
        {
            return get_object_vars($this);
        }

        /**
         * @return string
         */
        public function getUserName(): string
        {
            return $this->UserName;
        }

        /**
         * @param string $UserName
         */
        private function setUserName(string $UserName): void
        {
            $this->UserName = $UserName;
        }

        /**
         * @return string
         */
        public function getProfile(): string
        {
            return $this->Profile;
        }

        /**
         * @param string $Profile
         */
        private function setProfile(string $Profile): void
        {
            $this->Profile = $Profile;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->Name;
        }

        /**
         * @param string $Name
         */
        private function setName(string $Name): void
        {
            $this->Name = $Name;
        }

        /**
         * @return string
         */
        public function getEmail(): string
        {
            return $this->Email;
        }

        /**
         * @param string $Email
         */
        private function setEmail(string $Email): void
        {
            $this->Email = $Email;
        }

        /**
         * @return string
         */
        public function getUserId(): string
        {
            return $this->Id;
        }

        /**
         * @param string $Id
         */
        public function setId(string $Id): void
        {
            $this->Id = $Id;
        }

        /**
         * @return string
         */
        public function getRole(): string
        {
            return $this->Role;
        }

        /**
         * @param string $role
         */
        public function setRole(string $role): void
        {
            $this->Role = $role;
        }

        /**
         * @return string
         */
        public function getNameToKnow(): string
        {
            return $this->NameToKnow;
        }

        /**
         * @param string $NameToKnow
         */
        public function setNameToKnow(string $NameToKnow): void
        {
            $this->NameToKnow = $NameToKnow;
        }
    }
}
