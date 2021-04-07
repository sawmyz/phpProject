<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\StatesEntity;

class streets extends Model {
    public $_table = 'tblStates';
    public $_key = 'state_id';
    public $_Entity =  \model\Entity\streetsEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var StatesEntity $streets */
        foreach (self::getAllActives() as $streets) {
            $output[] = HtmlTags::Option()->Value("$streets->state_id")->Content($streets->streets_name);
        }
        return implode('', $output);
    }
}