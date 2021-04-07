<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\GuaranteeDocumentsEntity;
use model\GuaranteeBirthCertificate;
use model\GuaranteeCertificateRights;
use model\GuaranteeChecks;
use model\GuaranteeContracts;
use model\GuaranteeGuarantorChecks;
use model\GuaranteeGuarantorRightsCertificates;
use model\GuaranteeIdentitys;
use model\GuaranteeNationalCard;
use model\GuaranteePromissory;

class GuaranteeDocumentsConfirm extends ControllerScheme
{
    const name = 'تایید خرید اعتباری';


    public function getFileDetails()
    {

        $data = \model\GuaranteeDocuments::getOneFiltered('guarantee_documents_id', $_POST['documents_id']);


        $creditData = \model\CreditFile::getOneFiltered("credit_file_filenumber", $data->credit_file_filenumber);
        $output = [
            'credit_file_requested_credit' => $creditData->credit_file_requested_credit,            //اعتبار درخواستی
            'credit_file_refund' => $creditData->credit_file_refund,                                //باز پرداخت
            'credit_file_monthly_profit' => $creditData->credit_file_monthly_profit,                //سود ماهیانه
            'credit_file_payment_amount' => $creditData->credit_file_payment_amount,                //مبلغ قابل پرداخت
            'credit_file_guaranteed_check' => $creditData->credit_file_guaranteed_check,            //مبلغ چک تضمینی
        ];

        return $output;
    }

    public function main()
    {
        if ($this->requestArray()['documents_id'] > 0){
            return $this->view($this->viewName(),'add',[
                $this->model()->get($this->requestArray()['documents_id'])
            ]);
        }

        return $this->view($this->viewName(), 'main', [
            $this->model()->getAllFiltered('guarantee_documents_status', 0)
        ]);
    }

    public function add(?bool $csrf = false)
    {
        $data = $this->requestArray();
        $document_id = $data['guarantee_documents_id'];
        $document = \model\GuaranteeDocuments::get($data['guarantee_documents_id']);


        if ($data['birth_certificate_status'] == 1) {
            GuaranteeBirthCertificate::edit(GuaranteeBirthCertificate::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_birth_certificate_id, [
                'birth_certificate_status' => -1,
                'birth_certificate_desc' => $data['birth_certificate_desc'],
            ]);
        } else {
            GuaranteeBirthCertificate::edit(GuaranteeBirthCertificate::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_birth_certificate_id, [
                'birth_certificate_status' => 1,
                'birth_certificate_desc' => '',
            ]);
        }

        if ($data['certificate_rights_status'] == 1) {
            GuaranteeCertificateRights::edit(GuaranteeCertificateRights::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_certificate_rights_id, [
                'certificate_rights_status' => -1,
                'certificate_rights_desc' => $data['certificate_rights_desc'],
            ]);
        } else {
            GuaranteeCertificateRights::edit(GuaranteeCertificateRights::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_certificate_rights_id, [
                'certificate_rights_status' => 1,
                'certificate_rights_desc' => '',
            ]);
        }
        if ($data['national_card_status'] == 1) {
            GuaranteeNationalCard::edit(GuaranteeNationalCard::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_national_card_id, [
                'national_card_status' => -1,
                'national_card_desc' => $data['national_card_desc']
            ]);

        } else {
            GuaranteeNationalCard::edit(GuaranteeNationalCard::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_national_card_id, [
                'national_card_status' => 1,
                'national_card_desc' => '',
            ]);
        }

        if ($data['contract_status'] == 1) {
            GuaranteeContracts::edit(GuaranteeContracts::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_contract_id, [
                'contract_status' => -1,
                'contract_desc' => $data['contract_desc'],
            ]);
        } else {
            GuaranteeContracts::edit(GuaranteeContracts::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_contract_id, [
                'contract_status' => 1,
                'contract_desc' => '',
            ]);
        }

        if ($data['check_status'] == 1) {
            GuaranteeChecks::edit(GuaranteeChecks::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_check_id, [
                'check_status' => -1,
                'check_desc' => $data['check_desc'],
            ]);
        } else {
            GuaranteeChecks::edit(GuaranteeChecks::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_check_id, [
                'check_status' => 1,
                'check_desc' => '',
            ]);
        }

        if ($data['promissory_status'] == 1) {
            GuaranteePromissory::edit(GuaranteePromissory::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_promissory_id, [
                'promissory_status' => -1,
                'promissory_desc' => $data['promissory_desc'],
            ]);
        } else {
            GuaranteePromissory::edit(GuaranteePromissory::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_promissory_id, [
                'promissory_status' => 1,
                'promissory_desc' => '',
            ]);
        }

        if ($data['guarantor_check_status'] == 1) {
            GuaranteeGuarantorChecks::edit(GuaranteeGuarantorChecks::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_guarantor_check_id, [
                'guarantor_check_status' => -1,
                'guarantor_check_desc' => $data['guarantor_check_desc'],
            ]);
        } else {
            GuaranteeGuarantorChecks::edit(GuaranteeGuarantorChecks::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_guarantor_check_id, [
                'guarantor_check_status' => 1,
                'guarantor_check_desc' => '',
            ]);
        }

        if ($data['Identity_status'] == 1) {
            GuaranteeIdentitys::edit(GuaranteeIdentitys::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_Identity_id, [
                'Identity_status' => -1,
                'Identity_desc' => $data['Identity_desc'],
            ]);
        } else {
            GuaranteeIdentitys::edit(GuaranteeIdentitys::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_Identity_id, [
                'Identity_status' => 1,
                'Identity_desc' => '',
            ]);
        }

        if ($data['guarantor_rights_certificate_status'] == 1) {
            GuaranteeGuarantorRightsCertificates::edit(GuaranteeGuarantorRightsCertificates::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_guarantor_rights_certificate_id, [
                'guarantor_rights_certificate_status' => -1,
                'guarantor_rights_certificate_desc' => $data['guarantor_rights_certificate_desc'],
            ]);
        } else {
            GuaranteeGuarantorRightsCertificates::edit(GuaranteeGuarantorRightsCertificates::getOneFiltered('guarantee_documents_id', $document_id)->guarantee_guarantor_rights_certificate_id, [
                'guarantor_rights_certificate_status' => 1,
                'guarantor_rights_certificate_desc' => '',
            ]);
        }


        if ($data['guarantor_rights_certificate_status'] == 2 && $data['Identity_status'] == 2 && $data['guarantor_check_status'] == 2 && $data['promissory_status'] == 2 && $data['check_status'] == 2 && $data['contract_status'] == 2 && $data['national_card_status'] == 2 && $data['certificate_rights_status'] == 2 && $data['birth_certificate_status'] == 2) {
            \model\GuaranteeDocuments::edit($document_id, [
                'guarantee_documents_status' => 1,

            ]);
        } else {
            \model\GuaranteeDocuments::edit($document_id, [
                'guarantee_documents_status' => -1,
            ]);
        }

        return showResult(true, '', '');

    }


}