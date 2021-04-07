<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class CustomerAddressesEntity extends EntityScheme {
    public $customer_address_id;
    public $customer_id;
    public $country_id;
    public $state_id;
    public $city_id;
    public $district_id;
    public $main_street;
    public $secondary_street;
    public $full;
    public $plaque;
    public $latitude;
    public $longitude;

    public function model() {
        return new \model\CustomerAddresses();
    }



    protected function dictionary(): array {
        return  [
            'customer_address_id' => 'customer_address_id',
            'customer_id' => 'customer_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'district_id' => 'district_id',
            'country_id' => 'country_id',
            'main_street' => 'customer_address_main_street',
            'secondary_street' => 'customer_address_secondary_street',
            'full' => 'customer_address_full',
            'plaque' => 'customer_address_plaque',
            'latitude' => 'customer_address_latitude',
            'longitude' => 'customer_address_longitude',
        ];
    }
}
