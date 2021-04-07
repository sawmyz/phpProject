<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class RangesEntity extends EntityScheme {
    public $range_id;
public $country_id;

public $state_id;

public $city_id;

public $district_id;

public $range_name;


    public function model() {
        return new \model\Ranges();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'range_id',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'district_id' => 'district_id',
            'range_name' => 'range_name',
        ];
    }
}
