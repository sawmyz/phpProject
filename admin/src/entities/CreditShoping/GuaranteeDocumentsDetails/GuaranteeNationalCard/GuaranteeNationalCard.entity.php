<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeNationalCardEntity extends EntityScheme {
    public $guarantee_national_card_id;
    public $guarantee_documents_id ;
    public $national_card_image ;
    public $national_card_number ;
    public $national_card_expiration ;
    public $national_card_status ;
    public $national_card_desc ;

    public function model() {
        return new \model\GuaranteeNationalCard();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_national_card_id'=>'guarantee_national_card_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'national_card_image ' => 'national_card_image',
            'national_card_number' => 'national_card_number',
            'national_card_expiration' => 'national_card_expiration',
            'national_card_status' => 'national_card_status',
            'national_card_desc' => 'national_card_desc',
        ];
    }
}
