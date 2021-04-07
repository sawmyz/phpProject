<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\StatesEntity;

class States  extends Model {
    public $_table = 'tblStates';
    public $_key = 'state_id';
    public $_Entity =  \model\Entity\StatesEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var StatesEntity $state */
        foreach (self::getAllActives() as $state) {
            $output[] = HtmlTags::Option()->Value("$state->state_id")->Content($state->state_name);
        }
        return implode('', $output);
    }
}