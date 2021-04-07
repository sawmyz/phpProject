<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class WorkGroupsEntity extends EntityScheme {
    public $workgroup_id;
    public $work_group_name;
    public $work_group_image;
    public $work_group_icon;

    public function model() {
        return new \model\WorkGroups();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'workgroup_id', 'name' => 'work_group_name', 'work_group_image' => 'work_group_image', 'work_group_icon' => 'work_group_icon',
        ];
    }
}
