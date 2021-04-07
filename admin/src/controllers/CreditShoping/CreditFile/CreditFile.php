<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CustomersEntity;

class CreditFile extends ControllerScheme
{
    const name = 'درخواست تشکیل پرونده';


    public function getFileDetails()
    {
        $fileId = $_POST['fileId'];
        $documentModel = $this->model()::get($fileId);
        $name = \model\Individuals::get(\model\Customers::get($documentModel->customer_id)->individual_id);
        $output = [
            'requested' => $documentModel->credit_file_requested_credit,
            'refund' => $documentModel->credit_file_refund,
            'monthly' => $documentModel->credit_file_monthly_profit,
            'amount' => $documentModel->credit_file_payment_amount,
            'check' => $documentModel->credit_file_guaranteed_check,
            'filenumber' => $documentModel->credit_file_filenumber,
            'customer' => $documentModel->customer_id,
            'name' => $name->individual_first_name . ' ' . $name->individual_last_name,
        ];

        return json_encode($output, JSON_UNESCAPED_UNICODE);
    }


    public function add(?bool $csrf = true)
    {
        $data = $this->requestArray();
        $info = [
            'customer_id' => $data['customer_id'],
            'credit_file_requested_credit' => $data['credit_file_requested_credit'],
            'credit_file_refund' => $data['credit_file_refund'],
            'credit_file_monthly_profit' => $data['credit_file_monthly_profit'],
            'credit_file_payment_amount' => $data['credit_file_payment_amount'],
            'credit_file_guaranteed_check' => $data['credit_file_guaranteed_check'],
            'credit_file_filenumber' => $data['credit_file_filenumber'],

        ];
        $res = $this->model()::add($info);
        return showResult($res > 0, 'شماره پرونده شما = ' . '( ' . $data['credit_file_filenumber'] . ' ) ' . 'ثبت اطلاعات ', '');
    }
}
