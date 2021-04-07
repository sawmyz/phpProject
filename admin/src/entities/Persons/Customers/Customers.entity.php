<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class CustomersEntity extends EntityScheme
{
    public $customer_id;
    public $national_code;
    public $email;
    public $password;
    public $postal_code;
    public $father_name;
    public $tell;
    public $birthday;
    public $code;
    public $individual_id;
    public $username;
    public $birthplace;
    public $marital_status;
    public $image;
    public $number_children;
    public $description;
    public $score;
    public $credit;
    public $smsCode;

    public function model()
    {
        return new \model\Customers();
    }


    protected function dictionary(): array
    {
        return [
            'customer_id' => 'customer_id',
            'level_id' => 'level_id',
            'national_code' => 'customer_national_code',
            'email' => 'customer_email',
            'password' => 'customer_password',
            'postal_code' => 'customer_postal_code',
            'father_name' => 'customer_father_name',
            'tell' => 'customer_tell',
            'birthday' => 'customer_birthday',
            'code' => 'customer_code',
            'individual_id' => 'individual_id',
            'username' => 'customer_username',
            'birthplace' => 'customer_birthplace',
            'marital_status' => 'customer_marital_status',
            'image' => 'customer_image',
            'number_children' => 'customer_number_children',
            'description' => 'customer_description',
            'score' => 'customer_score',
            'credit' => 'customer_credit',
            'smsCode' => 'customer_sms_code',
        ];
    }
}
