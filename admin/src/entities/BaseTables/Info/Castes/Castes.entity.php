<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class CastesEntity extends EntityScheme {
    public $id;
    public $name;
    public $workgroup_id;
    public $icon;
    public $minimum_percent;
    public $ceil_amount;

    public function model() {
        return new \model\Castes();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'caste_id',  'name' => 'caste_name',  'workgroup_id' => 'workgroup_id', 'icon' => 'caste_icon','minimum_percent' => 'minimum_percent','ceil_amount' => 'ceil_amount',
        ];
    }
}
