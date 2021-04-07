<?php
//GuaranteeGuarantorChecks
namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeIdentitys extends ControllerScheme
{
    const name = ' اطلاعات فرم احراز هویت';


	public function wizardAdd(?bool $csrf = false) {
		
		return $this->wizardAction(true);
	}
	
	public function wizardAction(bool $isAdd = true) {
		$data = $this->requestArray();
		$image = $data['Identity_image'];
		
		list($type, $image) = explode(';', $image);
		list(, $image) = explode(',', $image);
		$image = base64_decode($image);
		$name = "Identity_image" . time() . '.jpg';
		file_put_contents(__SOURCE__ . "images/GuaranteeIdentitys/$name", $image);
		$array =[
			'guarantee_documents_id' => $data['guarantee_documents_id'],
			'Identity_image' => $name,
			//            'Identity_fname' => $data['Identity_fname'],
			//            'Identity_lname' => $data['Identity_lname'],
			//            'Identity_mobile' => $data['Identity_mobile'],
			//            'Identity_tell' => $data['Identity_tell'],
			//            'Identity_state' => $data['Identity_state'],
			//            'Identity_city' => $data['Identity_city'],
			'identification_reference_id' => $data['identification_reference_id'],
			'Identity_status' => $data['Identity_status'],
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
	
    public function loadView()
    {

    }

    function addUpload()
    {
        $rF = '';
        foreach ((isset($this::$__uploads) ? $this::$__uploads : array()) as $name => $path) {
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
