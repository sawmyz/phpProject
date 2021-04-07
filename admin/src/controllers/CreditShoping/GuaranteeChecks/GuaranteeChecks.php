<?php

namespace controller;

use ControllerScheme;

class GuaranteeChecks extends ControllerScheme {
	const name = ' اطلاعات چک تضمین';
	
	
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['check_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "check_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeChecks/$name", $image);
		$array = [
			'guarantee_documents_id' => $data['guarantee_documents_id'],
			'check_image'            => $name,
			'check_branch_name'      => $data['check_branch_name'],
			'bank_id'                => $data['bank_id'],
			'check_price'            => $data['check_price'],
			'check_date'             => $data['check_date'],
			'check_status'           => $data['check_status'],
			'check_desc'             => $data['check_desc'],
			'check_bank_code'        => $data['check_desc'],
			'check_account_owner'    => $data['check_desc'],
			'check_account_number'   => $data['check_desc'],
			'check_number'           => $data['check_desc'],
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
