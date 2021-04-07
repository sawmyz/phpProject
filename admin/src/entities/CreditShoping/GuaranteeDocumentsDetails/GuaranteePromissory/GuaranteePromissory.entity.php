<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GuaranteePromissoryEntity extends EntityScheme {
    public $guarantee_promissory_id;
    public $guarantee_documents_id ;
    public $promissory_image ;
    public $promissory_price ;
    public $promissory_date ;
    public $promissory_desc ;
    public $promissory_status ;

    public function model() {
        return new \model\GuaranteePromissory();
    }


    protected function dictionary(): array {
        return  [
            'guarantee_promissory_id'=>'guarantee_promissory_id' ,
            'guarantee_documents_id' => 'guarantee_documents_id',
            'promissory_image ' => 'promissory_image',
            'promissory_price' => 'promissory_price',
            'promissory_date' => 'promissory_date',
            'promissory_desc' => 'promissory_desc',
            'promissory_status' => 'promissory_status',
        ];
    }
}
