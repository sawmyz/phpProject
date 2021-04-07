<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeDocuments extends ControllerScheme
{
    const name = 'سند تضمین اعتبار';

    public function getFileDetails()
    {
        $documentId = $_POST['documentId'];
        $documentModel = $this->model()::get($documentId)->credit_file_filenumber;
        $data = \model\CreditFile::getOneFiltered('credit_file_filenumber', $documentModel);
        $output = [
            'requested' => $data->credit_file_requested_credit,
            'refund' => $data->credit_file_refund,
            'monthly' => $data->credit_file_monthly_profit,
            'amount' => $data->credit_file_payment_amount,
            'check' => $data->credit_file_guaranteed_check,
            'filenumber' => $data->credit_file_filenumber,

        ];

        return json_encode($output, JSON_UNESCAPED_UNICODE);

    }
	
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();

		$array = [
			'customer_id' => $data['customer_id'],
			'credit_file_filenumber' => $data['credit_file_filenumber'],
			'guarantee_documents_id' => $data['guarantee_documents_id'],
		];
		if ($isAdd) {
			$id = $this->model()::add($array);
		} else {
			$edit = $this->model()::Db()->where('guarantee_documents_id', $data['guarantee_documents_id'])->update($array);
			if ($edit)
				$id = $this->model()::getOneFiltered("guarantee_documents_id", $data['guarantee_documents_id'])->{$this->Key()};
		}
		\model\GuaranteeDocuments::edit($data['guarantee_documents_id'], [
			'guarantee_birth_certificate_id' => $id,
		]);
		return $id;
	}
	
	public function wizardEdit(?bool $csrf = false) {
		return $this->wizardAction(false);
	}


}
