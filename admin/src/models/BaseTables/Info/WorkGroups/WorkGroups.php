<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\WorkGroupsEntity;

class  WorkGroups  extends Model {
    public $_table = 'tblWorkGroups';
    public $_key = 'workgroup_id';
    public $_Entity =  \model\Entity\WorkGroupsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var WorkGroupsEntity $workGroups */
        foreach (self::getAllActives() as $workGroups) {
            $output[] = HtmlTags::Option()->Value("$workGroups->workgroup_id")->Content($workGroups->work_group_name);
        }
        return implode('', $output);
    }
}