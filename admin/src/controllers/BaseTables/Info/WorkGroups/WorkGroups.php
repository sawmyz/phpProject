<?php
namespace controller;
//include __BASE_DIR__.'src/autoload.php';
use Api\ApiInterface;
use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use DATABASE\ORM\QueryBuilder\QueryBuilder\Db;


class WorkGroups extends ControllerScheme {
    use ApiInterface;

    const name = 'workgroup_id';
    public static $__uploads = ["work_group_icon" => __SOURCE__."images/WorkGroups/","work_group_image" => __SOURCE__."images/WorkGroups/"];

    public function getgroups(){
        
        $model=$this->model()::getAll();
        $groups=array();
        foreach ($model as $mdl){
            array_push($groups,$mdl->work_group_name);
        }
        return $groups;
    }


}