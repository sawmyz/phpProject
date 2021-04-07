<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class ProviderBranchesEntity extends EntityScheme
{
    public $provider_branch_id;
    public $name;
    public $image;
    public $indiidual_id;
    public $telephone;
    public $country_id;
    public $state_id;
    public $city_id;
    public $district_id;
    public $range_id;
    public $district_ids;
    public $latitude;
    public $longitude;
    public $post_code;
    public $has_auth_yes_no;
    public $auth_number;
    public $work_hours;
    public $social_media;
    public $main_street;
    public $secondary_street;
    public $address_full;
    public $plaque;


    public function model()
    {
        return new \model\ProviderBranches();
    }


    protected function dictionary(): array
    {
        return [
            'provider_branch_id' => 'provider_branch_id',
            'name' => 'provider_branch_name',
            'image' => 'provider_branch_image',
            'individual_id' => 'individual_id',
            'telephone' => 'provider_branch_telephone',
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'district_id' => 'district_id',
            'range_id' => 'range_id',
            'district_ids' => 'district_ids',
            'latitude' => 'provider_branch_latitude',
            'longitude' => 'provider_branch_longitude',
            'post_code' => 'provider_branch_post_code',
            'has_auth_yes_no' => 'provider_branch_has_auth_yes_no',
            'auth_number' => 'provider_branch_auth_number',
            'work_hours' => 'provider_branch_work_hours',
            'social_media' => 'provider_branch_social_media',
            'main_street' => 'provider_branch_main_street',
            'secondary_street' => 'provider_branch_secondary_street',
            'address_full' => 'provider_branch_address_full',
            'plaque' => 'provider_branch_plaque',
        ];
    }
}
