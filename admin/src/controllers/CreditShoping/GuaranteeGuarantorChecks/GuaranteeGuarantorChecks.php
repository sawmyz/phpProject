<?php
//GuaranteeGuarantorChecks
namespace controller;

use ControllerScheme;

class GuaranteeGuarantorChecks extends ControllerScheme {
	const name = ' اطلاعات چک ضامن';

//    public function wizardAdd(?bool $csrf = true){
//
//        $info = [
//            'guarantor_check_image' => $_POST['guarantor_check_image'],
//            'guarantee_documents_id' => $_POST['guarantee_documents_id'],
//            'guarantor_check_bank_name' => $_POST['guarantor_check_bank_name'],
//            'guarantor_check_branch_name' => $_POST['guarantor_check_branch_name'],
//            'guarantor_check_price' => $_POST['guarantor_check_price'],
//            'guarantor_check_date' => $_POST['guarantor_check_date'],
//        ];
//        $res = $this->model()::add($info);
//        return parent::add($csrf);
//    }

	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['guarantor_check_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "guarantor_check_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeGuarantorChecks/$name", $image);
		$array =[
			'guarantee_documents_id'      => $data['guarantee_documents_id'],
			'guarantor_check_image'       => $name,
			'bank_id'                     => $data['bank_id'],
			'guarantor_check_branch_name' => $data['guarantor_check_branch_name'],
			'guarantor_check_price'       => $data['guarantor_check_price'],
			'guarantor_check_status'      => $data['guarantor_check_status'],
			'guarantor_check_desc'        => $data['guarantor_check_desc'],
			'guarantor_bank_code'         => $data['guarantor_bank_code'],
			'guarantor_account_number'    => $data['guarantor_account_number'],
			'guarantor_number'            => $data['guarantor_number'],
			'guarantor_account_owner'     => $data['guarantor_account_owner'],
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
