<?php
//GuaranteePromissory
namespace controller;

use ControllerScheme;

class GuaranteePromissory extends ControllerScheme {
	const name = ' اطلاعات سفته تضمین';

//    public function wizardAdd(?bool $csrf = true){
//
//        $info = [
//            'promissory_image' => $_POST['promissory_image'] ,
//            'promissory_price	' => $_POST['promissory_price'] ,
//            'promissory_date' => $_POST['promissory_date'] ,
//            'promissory_desc' => $_POST['promissory_desc'] ,
//        ];
//        $res = $this->model()::add($info);
//        return parent::add($csrf);
//    }
	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['promissory_image'];
		[$type, $image] = explode(';', $image);
		[, $image] = explode(',', $image);
		$image = base64_decode($image);
		$name = "promissory_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteePromissory/$name", $image);
		$array = [
			'guarantee_documents_id' => $data['guarantee_documents_id'],
			'promissory_image'       => $name,
			'promissory_price'       => $data['promissory_price'],
			'promissory_date'        => $data['promissory_date'],
			'promissory_status'      => $data['promissory_status'],
			'promissory_desc'        => $data['promissory_desc'],
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
