<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeDocumentsEntity extends EntityScheme {
    public $guarantee_documents_id;
    public $credit_file_filenumber ;
    public $guarantee_birth_certificate ;
    public $guarantee_national_card ;
    public $guarantee_certificate_rights ;
    public $guarantee_contract ;
    public $guarantee_check ;
    public $guarantee_promissory ;
    public $guarantee_guarantor_check ;
    public $guarantee_Identity ;
    public $guarantee_guarantor_rights_certificate ;
    public $customer_id ;
    public $guarantee_documents_status ;

    public function model() {
        return new \model\GuaranteeDocuments();
    }

    protected function dictionary(): array {
        return  [
            'guarantee_documents_id'=>'guarantee_documents_id' ,
            'credit_file_filenumber' => 'credit_file_filenumber',
            'guarantee_birth_certificate ' => 'guarantee_birth_certificate',
            'guarantee_national_card' => 'guarantee_national_card',
            'guarantee_certificate_rights' => 'guarantee_certificate_rights',
            'guarantee_contract' => 'guarantee_contract',
            'guarantee_check' => 'guarantee_check',
            'guarantee_promissory' => 'guarantee_promissory',
            'guarantee_guarantor_check' => 'guarantee_guarantor_check',
            'guarantee_Identity' => 'guarantee_Identity',
            'guarantee_guarantor_rights_certificate' => 'guarantee_guarantor_rights_certificate',
            'customer_id' => 'customer_id',
            'guarantee_documents_status' => 'guarantee_documents_status',
        ];
    }
}
