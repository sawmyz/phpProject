<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class EducationsEntity extends EntityScheme {
    public $education_id;
public $name;


    public function model() {
        return new \model\Educations();
    }



    protected function dictionary(): array {
        return  [
            'education_id' => 'education_id','name' => 'education_name',
        ];
    }
}
