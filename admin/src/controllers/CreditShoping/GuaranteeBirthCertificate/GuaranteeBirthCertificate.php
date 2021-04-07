<?php

namespace controller;

use ControllerScheme;

class GuaranteeBirthCertificate extends ControllerScheme {
	const name = 'اطلاعات شناسنامه';
	public static $__uploads = ["birth_certificate_image" => __SOURCE__ . "images/GuaranteeBirthCertificate/"];
	
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['birth_certificate_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "birth_certificate_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeBirthCertificate/$name", $image);
		$array = [
			'guarantee_documents_id'        => $data['guarantee_documents_id'],
			'birth_certificate_image'       => $name,
			'birth_certificate_number'      => $data['birth_certificate_number'],
			'birth_certificate_date'        => $data['birth_certificate_date'],
			'birth_certificate_place'       => $data['birth_certificate_place'],
			'birth_certificate_father_name' => $data['birth_certificate_father_name'],
			'birth_certificate_serial'      => $data['birth_certificate_serial'],
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
