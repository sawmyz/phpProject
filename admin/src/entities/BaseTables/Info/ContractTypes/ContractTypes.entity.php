<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class ContractTypesEntity extends EntityScheme {
    public $id;
    public $name;

    public function model() {
        return new \model\ContractTypes();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'contracttype_id',   'name' => 'contract_type_name',
        ];
    }
}
