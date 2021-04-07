<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class streetsEntity extends EntityScheme {


    public $streets_id;

    public $country_id;

    public $state_id;

    public $city_id;

    public $district_id;

    public $range_name;


    public function model() {
        return new \model\streets();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'streets_id',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'district_id' => 'district_id',
            'range_id' => 'range_id',
            'streets_name' => 'streets_name',
        ];
    }
}
