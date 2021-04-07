<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class SendDocumentsEntity extends EntityScheme {


    public $send_guarantee_documents_id;
    public $guarantee_documents_id ;
    public $credit_file_filenumber ;
    public $guarantee_birth_certificate_id ;
    public $guarantee_national_card_id ;
    public $guarantee_certificate_rights_id ;
    public $guarantee_contract_id ;
    public $guarantee_check_id ;
    public $guarantee_promissory_id ;
    public $guarantee_guarantor_check_id ;
    public $guarantee_Identity_id ;
    public $guarantee_guarantor_rights_certificate_id ;
    public $send_guarantee_documents_code ;
    public $send_guarantee_documents_date ;


    public function model() {
        return new \model\SendDocuments();
    }


    protected function dictionary(): array {
        return  [
            'send_guarantee_documents_id'=>'send_guarantee_documents_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'credit_file_filenumber ' => 'credit_file_filenumber',
            'guarantee_birth_certificate_id' => 'guarantee_birth_certificate_id',
            'guarantee_national_card_id' => 'guarantee_national_card_id',
            'guarantee_certificate_rights_id' => 'guarantee_certificate_rights_id',
            'guarantee_contract_id' => 'guarantee_contract_id',
            'guarantee_check_id' => 'guarantee_check_id',
            'guarantee_promissory_id' => 'guarantee_promissory_id',
            'guarantee_guarantor_check_id' => 'guarantee_guarantor_check_id',
            'guarantee_Identity_id' => 'guarantee_Identity_id',
            'guarantee_guarantor_rights_certificate_id' => 'guarantee_guarantor_rights_certificate_id',
            'send_guarantee_documents_code' => 'send_guarantee_documents_code',
            'send_guarantee_documents_date' => 'send_guarantee_documents_date',

        ];
    }
}
