<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class CreditFileEntity extends EntityScheme {
    public $customer_id;
    public $credit_file_requested_credit;
    public $credit_file_refund;
    public $credit_file_monthly_profit;
    public $credit_file_payment_سamount;
    public $credit_file_guaranteed_check;
    public $credit_file_filenumber;

    public function model() {
        return new \model\Acceptorpictures();
    }



    protected function dictionary(): array {
        return  [
            'credit_file_id'=>'credit_file_id' ,
            'customer_id' => 'customer_id',
            'credit_file_requested_credit' => 'credit_file_requested_credit',
            'credit_file_refund' => 'credit_file_refund',
            'credit_file_monthly_profit' => 'credit_file_monthly_profit',
            'credit_file_payment_amount' => 'credit_file_payment_amount',
            'credit_file_guaranteed_check' => 'credit_file_guaranteed_check',
            'credit_file_filenumber' => 'credit_file_filenumber',
        ];
    }
}
