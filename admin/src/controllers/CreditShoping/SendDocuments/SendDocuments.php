<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;

//use model\Entity\SendGuaranteeDocumentsEntity;

class SendDocuments extends ControllerScheme
{
    const name = 'ارسال فیزیکی مدارک تضمین';


    public function add(?bool $csrf = true)
    {
        $data = $this->requestArray();
        $data = [
            "guarantee_documents_id" => $data['guarantee_documents_id'],
            "send_guarantee_documents_code" => $data['send_guarantee_documents_code'],
            "guarantee_birth_certificate_id" => $data['guarantee_birth_certificate_id'],
            "guarantee_national_card_id" => $data['guarantee_national_card_id'],
            "guarantee_certificate_rights_id" => $data['guarantee_certificate_rights_id'],
            "guarantee_contract_id" => $data['guarantee_contract_id'],
            "guarantee_check_id" => $data['guarantee_check_id'],
            "guarantee_promissory_id" => $data['guarantee_promissory_id'],
            "guarantee_guarantor_check_id" => $data['guarantee_guarantor_check_id'],
            "send_guarantee_documents_date" => $data['send_guarantee_documents_date'],
            "guarantee_Identity_id" => $data['guarantee_Identity_id'],
            "guarantee_guarantor_rights_certificate_id" => $data['guarantee_guarantor_rights_certificate_id'],
            "credit_file_filenumber" => \model\GuaranteeDocuments::get($data['guarantee_documents_id'])->credit_file_filenumber,
        ];
        \model\GuaranteeDocuments::edit($data['guarantee_documents_id'], [
            "guarantee_documents_status" => 3,
        ]);

        if ($this->model()::add($data)) {
            return showResult(true, '', '');
        }
        return showResult(false, '', '');

    }

    public function main()
    {

        return $this->view($this->viewName(), 'main', [
            \model\GuaranteeDocuments::getAllFiltered('guarantee_documents_status', 1)
        ]);
    }

}