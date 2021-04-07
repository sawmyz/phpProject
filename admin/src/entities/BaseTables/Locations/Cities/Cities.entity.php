<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class CitiesEntity extends EntityScheme
{
    public $city_id;
    public $country_id;
    public $state_id;
    public $name;

    public function model()
    {
        return new \model\Cities();
    }


    protected function dictionary(): array
    {
        return [
            'city_id' => 'city_id',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'name' => 'city_name',
        ];
    }
}
