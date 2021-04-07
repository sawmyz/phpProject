<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class DistrictsEntity extends EntityScheme {
    public $district_id;
public $country_id;

public $state_id;

public $city_id;

public $name;


    public function model() {
        return new \model\Districts();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'district_id',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'name' => 'district_name',
        ];
    }
}
