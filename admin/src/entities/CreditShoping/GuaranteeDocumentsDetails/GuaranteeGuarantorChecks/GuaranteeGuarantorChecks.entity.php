<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeGuarantorChecksEntity extends EntityScheme {
    public $guarantee_guarantor_check_id;
    public $guarantee_documents_id ;
    public $guarantor_check_image ;
    public $guarantor_check_bank_name ;
    public $guarantor_check_branch_name ;
    public $guarantor_check_price ;
    public $guarantor_check_date ;
    public $guarantor_check_status ;

    public function model() {
        return new \model\GuaranteeGuarantorChecks();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_guarantor_check_id'=>'guarantee_guarantor_check_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'guarantor_check_image ' => 'guarantor_check_image',
            'guarantor_check_bank_name' => 'guarantor_check_bank_name',
            'guarantor_check_branch_name' => 'guarantor_check_branch_name',
            'guarantor_check_price' => 'guarantor_check_price',
            'guarantor_check_date' => 'guarantor_check_date',
            'guarantor_check_status' => 'guarantor_check_status',
        ];
    }
}
