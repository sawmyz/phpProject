<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class GrantPurchaseCreditsEntity extends EntityScheme {
    public $grant_purchase_credit_id;
    public $credit_file_filenumber;
    public $customer_credit_account_number;
    public $grant_purchase_credit_date;
    public $grant_purchase_credit_status;
    public $grant_purchase_credit_price;
    public function model() {
        return new \model\GrantPurchaseCredits();
    }



    protected function dictionary(): array {
        return  [
            'grant_purchase_credit_id'=>'grant_purchase_credit_id' ,
            'credit_file_filenumber' => 'credit_file_filenumber',
            'customer_credit_account_number' => 'customer_credit_account_number',
            'grant_purchase_credit_date' => 'grant_purchase_credit_date',
            'grant_purchase_credit_status' => 'grant_purchase_credit_status',
            'grant_purchase_credit_price' => 'grant_purchase_credit_price',
        ];
    }
}
