<?php
//GuaranteeGuarantorRightsCertificates
namespace controller;

use ControllerScheme;

class GuaranteeGuarantorRightsCertificates extends ControllerScheme {
	const name = ' اطلاعات گواهی کسر از حقوق ضامن';
//
//    public function wizardAdd(?bool $csrf = true){
//
//        $info = [
//            'guarantor_rights_certificate_image' => $_POST['guarantor_rights_certificate_image'] ,
//            'guarantee_documents_id' => $_POST['guarantee_documents_id'] ,
//            'guarantor_rights_certificate_date_from' => $_POST['guarantor_rights_certificate_date_from'] ,
//            'guarantor_rights_certificate_date_to' => $_POST['guarantor_rights_certificate_date_to'] ,
//            'guarantor_rights_certificate_exporter' => $_POST['guarantor_rights_certificate_exporter'] ,
//            'guarantor_rights_certificate_price' => $_POST['guarantor_rights_certificate_price'] ,
//            'guarantor_rights_certificate_fname' => $_POST['guarantor_rights_certificate_fname'] ,
//            'guarantor_rights_certificate_lname' => $_POST['guarantor_rights_certificate_lname'] ,
//            'guarantor_rights_certificate_national_code' => $_POST['guarantor_rights_certificate_national_code'] ,
//        ];
//        $res = $this->model()::add($info);
//        return parent::add($csrf);
//    }

	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['guarantor_rights_certificate_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "guarantor_rights_certificate_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeGuarantorRightsCertificates/$name", $image);
		$array =[
			'guarantee_documents_id'                      => $data['guarantee_documents_id'],
			'guarantor_rights_certificate_date_from'      => $data['guarantor_rights_certificate_date_from'],
			'guarantor_rights_certificate_date_to'        => $data['guarantor_rights_certificate_date_to'],
			'guarantor_rights_certificate_exporter'       => $data['guarantor_rights_certificate_exporter'],
			'guarantor_rights_certificate_price'          => $data['guarantor_rights_certificate_price'],
			'guarantor_rights_certificate_fname'          => $data['guarantor_rights_certificate_fname'],
			'guarantor_rights_certificate_lname'          => $data['guarantor_rights_certificate_lname'],
			'guarantor_rights_certificate_national_code'  => $data['guarantor_rights_certificate_national_code'],
			'guarantor_rights_certificate_status'         => $data['guarantor_rights_certificate_status'],
			'guarantor_rights_certificate_image'          => $name,
			'guarantor_rights_certificate_desc'           => $data['guarantor_rights_certificate_desc'],
			'guarantor_rights_certificate_receipt_number' => $data['guarantor_rights_certificate_receipt_number'],
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
	
	
	
	public function loadView() {
	
	}
	
	function addUpload() {
		$rF = '';
		foreach ((isset($this::$__uploads) ? $this::$__uploads : []) as $name => $path) {
			if (isset($_FILES[$name]['name']) and strlen($_FILES[$name]['name']) > 0) {
				$checkImage = checkImage($this->requestArray());
				if ($checkImage) {
					$fileName = uploadImage($_FILES[$name], $checkImage, $path, true, $name);
				} else {
					$fileName = uploadImage($_FILES[$name], $checkImage, $path, false, $name);
				}
				$rF = $fileName;
			}
		}
		return $rF;
	}
}
