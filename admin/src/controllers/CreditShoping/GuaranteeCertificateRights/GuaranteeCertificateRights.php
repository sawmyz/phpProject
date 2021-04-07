<?php
//GuaranteeCertificateRights
namespace controller;

use ControllerScheme;

class GuaranteeCertificateRights extends ControllerScheme {
	const name = 'اطلاعات گواهی کسر از حقوق';
	
	
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['national_card_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "national_card_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeCertificateRights/$name", $image);
		$array = [
			'guarantee_documents_id' => $data['guarantee_documents_id'],
			'certificate_rights_date_from' => $data['certificate_rights_date_from'],
			'certificate_rights_date_to' => $data['certificate_rights_date_to'],
			'certificate_rights_exporter' => $data['certificate_rights_exporter'],
			'certificate_rights_price' => $data['certificate_rights_price'],
			'guarantee_certificate_rights_image' => $name,
			'certificate_rights_status' => $data['certificate_rights_status'],
			'certificate_rights_desc' => $data['certificate_rights_desc'],
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
