<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class StatesEntity extends EntityScheme
{
    public $state_id;
    public $country_id;
    public $name;


    public function model()
    {
        return new \model\States();
    }


    protected function dictionary(): array
    {
        return [
            'state_id' => 'state_id',
            'country_id' => 'country_id',
            'name' => 'state_name',
        ];
    }
}
