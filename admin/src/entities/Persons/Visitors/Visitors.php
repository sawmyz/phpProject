<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class VisitorsEntity extends EntityScheme
{
    public $visitor_id;
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
    public $referer_username;
    public $visitor_identity_serial;
    public $state_id;
    public $city_id;
    public $address;
    public $card_issuance;
    public $user_id;

    public function model()
    {
        return new \model\Visitors();
    }


    protected function dictionary(): array
    {
        return [
            'visitor_id' => 'visitor_id',
            'national_code' => 'visitor_national_code',
            'email' => 'visitor_email',
            'password' => 'visitor_password',
            'postal_code' => 'visitor_postal_code',
            'father_name' => 'visitor_father_name',
            'address' => 'visitor_address',
            'tell' => 'visitor_tell',
            'birthday' => 'visitor_birthday',
            'code' => 'visitor_code',
            'individual_id' => 'individual_id',
            'identity_serial' => 'visitor_identity_serial',
            'username' => 'visitor_username',
            'birthplace' => 'visitor_birthplace',
            'marital_status' => 'visitor_marital_status',
            'image' => 'visitor_image',
            'number_children' => 'visitor_number_children',
            'description' => 'visitor_description',
            'score' => 'visitor_score',
            'credit' => 'visitor_credit',
            'referer_username' => 'visitor_referer_username',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'card'=>'visitor_card',
            'card_issuance'=>'visitor_card_issuance',
            'user_id'=>'user_id',
        ];
    }
}
