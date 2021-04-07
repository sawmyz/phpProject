<?php

namespace model;

use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\SupervisorsEntity;

class Supervisors extends Model
{
    public $_table = 'UsersTable';
    public $_key = 'user_id';
    public $_Entity = SupervisorsEntity::class;

//    public static function toOption()
//    {
//        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
//        /** @var IndividualsEntity $individual */
//        foreach (self::getAll() as $individual) {
//            $output[] = HtmlTags::Option()->Value($individual->individual_id)->Content($individual->first_name . ' ' . $individual->last_name . ' - ' . $individual->mobile);
//        }
//        return implode('', $output);
//    }
    public static function toSupervisorsOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var SupervisorsEntity $supervisors */
        foreach (self::getAllFiltered('role_name' , 'SupervisorsRole') as $supervisors) {
            $output[] = HtmlTags::Option()->Value($supervisors->user_id)->Content($supervisors->user_name);
        }
        return implode('', $output);
    }


    public function main()
    {
        return $this->view($this->viewName(), 'main', [
            $this->model()->getAllFiltered('role_name', 'SupervisorsRole')
        ]);
    }

}