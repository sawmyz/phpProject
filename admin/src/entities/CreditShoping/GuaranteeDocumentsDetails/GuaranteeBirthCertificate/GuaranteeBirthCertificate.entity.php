<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeBirthCertificateEntity extends EntityScheme {
    public $guarantee_birth_certificate_id;
    public $guarantee_documents_id ;
    public $birth_certificate_image ;
    public $birth_certificate_number ;
    public $birth_certificate_date ;
    public $birth_certificate_place ;
    public $birth_certificate_father_name ;
    public $birth_certificate_serial ;
    public $birth_certificate_status ;

    public function model() {
        return new \model\GuaranteeBirthCertificate();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_birth_certificate_id'=>'guarantee_birth_certificate_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'birth_certificate_image ' => 'birth_certificate_image',
            'birth_certificate_number' => 'birth_certificate_number',
            'birth_certificate_date' => 'birth_certificate_date',
            'birth_certificate_place' => 'birth_certificate_place',
            'birth_certificate_father_name' => 'birth_certificate_father_name',
            'birth_certificate_serial' => 'birth_certificate_serial',
            'birth_certificate_status' => 'birth_certificate_status',
        ];
    }
}
