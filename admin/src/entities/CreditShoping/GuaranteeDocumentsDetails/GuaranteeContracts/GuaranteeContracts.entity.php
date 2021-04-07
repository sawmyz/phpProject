<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteeContractsEntity extends EntityScheme {
    public $guarantee_contract_id;
    public $guarantee_documents_id ;
    public $contract_date ;
    public $contract_number ;
    public $contract_image ;
    public $contract_desc ;
    public $contract_status ;

    public function model() {
        return new \model\GuaranteeContracts();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_contract_id'=>'guarantee_contract_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'contract_date ' => 'contract_date',
            'contract_number' => 'contract_number',
            'contract_image' => 'contract_image',
            'contract_desc' => 'contract_desc',
            'contract_status' => 'contract_status',
        ];
    }
}
