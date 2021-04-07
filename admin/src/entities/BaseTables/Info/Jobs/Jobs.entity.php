<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class JobsEntity extends EntityScheme {
    public $job_id;
    public $name;
    public $education_id;
    public $caste_id;
    public $workgroup_id;


    public function model() {
        return new \model\Jobs();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'job_id','name' => 'job_name','education_id' => 'education_id','caste_id' => 'caste_id','workgroup_id' => 'workgroup_id',
        ];
    }
}
