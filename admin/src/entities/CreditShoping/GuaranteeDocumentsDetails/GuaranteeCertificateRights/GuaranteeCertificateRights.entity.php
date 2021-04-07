<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeCertificateRightsEntity extends EntityScheme {
    public $guarantee_certificate_rights_id;
    public $guarantee_documents_id ;
    public $certificate_rights_date_from ;
    public $certificate_rights_date_to ;
    public $certificate_rights_exporter ;
    public $certificate_rights_price ;
    public $certificate_rights_status ;
    public $guarantee_certificate_rights_image ;

    public function model() {
        return new \model\GuaranteeCertificateRights();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_certificate_rights_id'=>'guarantee_certificate_rights_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'certificate_rights_date_from ' => 'certificate_rights_date_from',
            'certificate_rights_date_to' => 'certificate_rights_date_to',
            'certificate_rights_exporter' => 'certificate_rights_exporter',
            'certificate_rights_price' => 'certificate_rights_price',
            'certificate_rights_status' => 'certificate_rights_status',
            'guarantee_certificate_rights_image' => 'guarantee_certificate_rights_image',
        ];
    }
}
