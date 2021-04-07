<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeIdentitysEntity extends EntityScheme {
    public $guarantee_Identity_id;
    public $guarantee_documents_id ;
    public $Identity_fname ;
    public $Identity_lname ;
    public $Identity_mobile ;
    public $Identity_tell ;
    public $Identity_state ;
    public $Identity_city ;
    public $Identity_address ;
    public $Identity_status ;
    public $Identity_image ;
    public $Identity_desc ;

    public function model() {
        return new \model\GuaranteeIdentitys();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_Identity_id'=>'guarantee_Identity_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'Identity_fname ' => 'Identity_fname',
            'Identity_lname' => 'Identity_lname',
            'Identity_mobile' => 'Identity_mobile',
            'Identity_tell' => 'Identity_tell',
            'Identity_state' => 'Identity_state',
            'Identity_city' => 'Identity_city',
            'Identity_address' => 'Identity_address',
            'Identity_status' => 'Identity_status',
            'Identity_image' => 'Identity_image',
            'Identity_desc' => 'Identity_desc',
        ];
    }
}
