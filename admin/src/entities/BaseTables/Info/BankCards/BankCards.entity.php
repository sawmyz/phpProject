<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class BankCardsEntity extends EntityScheme {
    public $bank_card_id;
public $bankcard_type;

public $id;


    public function model() {
        return new \model\BankCards();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'bank_card_id','bankcard_type' => 'bankcard_type','id' => 'bank_id',
        ];
    }
}
