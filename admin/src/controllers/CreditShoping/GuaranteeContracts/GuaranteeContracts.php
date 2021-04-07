<?php
//GuaranteeContracts
namespace controller;

use ControllerScheme;

class GuaranteeContracts extends ControllerScheme {
	const name = ' اطلاعات قرارداد مشتری';
	
	
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['contract_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "contract_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeContracts/$name", $image);
		$array = [
			'guarantee_documents_id' => $data['guarantee_documents_id'],
			'contract_date'          => $data['contract_date'],
			'contract_number'        => $data['contract_number'],
			'contract_image'         => $name,
			'contract_status'        => $data['contract_status'],
			'contract_desc'          => $data['contract_desc'],
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
