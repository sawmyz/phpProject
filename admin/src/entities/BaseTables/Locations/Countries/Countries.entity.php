<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class CountriesEntity extends EntityScheme {
    public $country_id;
public $country_name;
public $Tel_prefixes;


    public function model() {
        return new \model\Countries();
    }



    protected function dictionary(): array {
        return  [
            'country_id' => 'country_id',
            'country_name' => 'country_name',
            'Tel_prefixes'=>'country_Tel_prefixes'
        ];
    }
}
