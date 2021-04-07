<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class IndividualsEntity extends EntityScheme
{
    public $individual_id;
    public $gender;
    public $first_name;
    public $last_name;
    public $mobile;

    public function model()
    {
        return new \model\Individuals();
    }

    protected function dictionary(): array
    {
        return [
            'individual_id' => 'individual_id',
            'gender' => 'individual_gender',
            'first_name' => 'individual_first_name',
            'last_name' => 'individual_last_name',
            'mobile' => 'individual_mobile',
        ];
    }
}
