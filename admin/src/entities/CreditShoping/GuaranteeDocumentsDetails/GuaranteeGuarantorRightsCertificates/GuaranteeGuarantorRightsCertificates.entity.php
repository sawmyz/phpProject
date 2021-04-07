<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeGuarantorRightsCertificatesEntity extends EntityScheme {
    public $guarantee_guarantor_rights_certificate_id;
    public $guarantee_documents_id ;
    public $guarantor_rights_certificate_date_from ;
    public $guarantor_rights_certificate_date_to ;
    public $guarantor_rights_certificate_exporter ;
    public $guarantor_rights_certificate_price ;
    public $guarantor_rights_certificate_fname ;
    public $guarantor_rights_certificate_lname ;
    public $guarantor_rights_certificate_national_code ;
    public $guarantor_rights_certificate_status ;

    public function model() {
        return new \model\GuaranteeGuarantorRightsCertificates();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_guarantor_rights_certificate_id'=>'guarantee_guarantor_rights_certificate_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'guarantor_rights_certificate_date_from ' => 'guarantor_rights_certificate_date_from',
            'guarantor_rights_certificate_date_to' => 'guarantor_rights_certificate_date_to',
            'guarantor_rights_certificate_exporter' => 'guarantor_rights_certificate_exporter',
            'guarantor_rights_certificate_price' => 'guarantor_rights_certificate_price',
            'guarantor_rights_certificate_fname' => 'guarantor_rights_certificate_fname',
            'guarantor_rights_certificate_lname' => 'guarantor_rights_certificate_lname',
            'guarantor_rights_certificate_national_code' => 'guarantor_rights_certificate_national_code',
            'guarantor_rights_certificate_status' => 'guarantor_rights_certificate_status',
        ];
    }
}
