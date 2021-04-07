<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeChecksEntity extends EntityScheme {
    public $guarantee_check_id;
    public $guarantee_documents_id ;
    public $check_image ;
    public $check_bank_name ;
    public $check_branch_name ;
    public $check_price ;
    public $check_date ;
    public $check_status ;

    public function model() {
        return new \model\GuaranteeChecks();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_check_id'=>'guarantee_check_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'check_image ' => 'check_image',
            'check_bank_name' => 'check_bank_name',
            'check_branch_name' => 'check_branch_name',
            'check_price' => 'check_price',
            'check_date' => 'check_date',
            'check_status' => 'check_status',
        ];
    }
}
