<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CustomersEntity;

class GrantPurchaseCredits extends ControllerScheme
{
    const name = 'اعطا خرید اعتباری';


    public function add(?bool $csrf = true)
    {
        $data = $this->requestArray();

        $fileNumber = \model\GuaranteeDocuments::get($data['guarantee_documents_id'])->credit_file_filenumber;
        $customerId = \model\CreditFile::getOneFiltered('credit_file_filenumber', $fileNumber)->customer_id;
        $credit = \model\Customers::get($customerId)->customer_credit;
        $newCredit = intval($credit) + intval($data['grant_purchase_credit_price']);

        \model\Customers::edit($customerId, [
            'customer_credit' => $newCredit,
        ]);

        \model\CreditFile::edit(\model\CreditFile::getOneFiltered('credit_file_filenumber', $fileNumber)->credit_file_id, [
            'credit_file_status' => 1,
        ]);
        \model\GuaranteeDocuments::edit($data['guarantee_documents_id'], [
            'guarantee_documents_status' => 4,
        ]);

        $res = $this->model()::add([
            'grant_purchase_credit_price' => $data['grant_purchase_credit_price'],
            'credit_file_filenumber' => $fileNumber,
            'customer_credit_account_number' => $data['customer_credit_account_number'],
            'grant_purchase_credit_status' => 1,
        ]);

        return showResult(true, '', '');
    }


}