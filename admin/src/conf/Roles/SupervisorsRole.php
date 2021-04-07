<?php

namespace FwAuthSystem\Role;

use controller\Acceptorpictures;
use controller\Providers;
use controller\ProviderBranches;
use FwAuthSystem\Utils\AuthRole;


if (!class_exists('FwAuthSystem\Role\SupervisorsRole')) {
    class SupervisorsRole extends AuthRole
    {
        public static function accessList(): array
        {
            // list of available controllers for this role
            return [
                Providers::class,
                ProviderBranches::class,
                Acceptorpictures::class,
            ];
        }

        public static function roleName(): string
        {
            // role main names
            return 'سرپرست';
        }
    }
}