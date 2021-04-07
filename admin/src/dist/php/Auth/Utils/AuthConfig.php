<?php
namespace FwAuthSystem\Utils;
if (!class_exists('FwAuthSystem\Utils\AuthConfig')) {
    class AuthConfig {
        public $_UsersTable = 'UsersTable';
        public $_UsersTableId = 'user_id';
        public $__UserName = 'user_username';
        public $__Password = 'user_password';
        public $__Profile = 'user_profile';
        public $__Name = 'user_name';
        public $__Email = 'user_email';
        public $__Role = 'role_name';
        public $__Last_Pass_1 = 'user_last_pass_1';
        public $__Last_Pass_2 = 'user_last_pass_2';
        public $__NameToKnow = 'user_nameToKnow';

        public function __construct(string $UsersTable = 'UsersTable',string  $_UsersTableId = 'user_id') {
            $this->_UsersTable = $UsersTable;
            $this->_UsersTableId = $_UsersTableId;
        }

        /**
         * @param string $_UserName
         * @return AuthConfig
         */
        public function SetUserName(string $_UserName): AuthConfig {
            $this->__UserName = $_UserName;
            return $this;
        }

        /**
         * @param string $_Password
         * @return AuthConfig
         */
        public function SetPassword(string $_Password): AuthConfig {
            $this->__Password = $_Password;
            return $this;
        }

        /**
         * @param string $_Profile
         * @return AuthConfig
         */
        public function SetProfile(string $_Profile): AuthConfig {
            $this->__Profile = $_Profile;
            return $this;
        }

        /**
         * @param string $_Name
         * @return AuthConfig
         */
        public function SetName(string $_Name): AuthConfig {
            $this->__Name = $_Name;
            return $this;
        }

        /**
         * @param string $_Email
         * @return AuthConfig
         */
        public function SetEmail(string $_Email): AuthConfig {
            $this->__Email = $_Email;
            return $this;
        }

        /**
         * @param string $_Last_Pass_1
         * @return AuthConfig
         */
        public function SetLastPass1(string $_Last_Pass_1): AuthConfig {
            $this->__Last_Pass_1 = $_Last_Pass_1;
            return $this;
        }

        /**
         * @param string $_Last_Pass_2
         * @return AuthConfig
         */
        public function SetLastPass2(string $_Last_Pass_2): AuthConfig {
            $this->__Last_Pass_2 = $_Last_Pass_2;
            return $this;
        }
    }
}
