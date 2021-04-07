<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class BanksEntity extends EntityScheme {
    public $bank_id;
public $name;
public $logo;


    public function model() {
        return new \model\Banks();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'bank_id','name' => 'bank_name','logo' => 'bank_logo',
        ];
    }
}
