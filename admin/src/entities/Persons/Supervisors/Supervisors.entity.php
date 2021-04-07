<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class SupervisorsEntity extends EntityScheme
{
    public $id;
    public $username;
    public $password;
    public $profile;
    public $name;
    public $email;
    public $role_name;
    public $nameToKnow;
    public $last_pass_1;
    public $last_pass_2;
    public $tmp_hash;


    public function model()
    {
        return new \model\Supervisors();
    }

    protected function dictionary(): array
    {
        return [
            'id' => 'user_id',
            'username' => 'user_username',
            'password' => 'user_password',
            'profile' => 'user_profile',
            'name' => 'user_name',
            'email' => 'user_email',
            'role_name' => 'role_name',
            'nameToKnow' => 'user_nameToKnow',
            'last_pass_1' => 'user_last_pass_1',
            'last_pass_2' => 'user_last_pass_2',
            'tmp_hash' => 'tmp_hash',

        ];
    }
}
