<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CastesEntity;

class Castes  extends Model {
    public $_table = 'tblCastes';
    public $_key = 'caste_id';
    public $_Entity =  \model\Entity\CastesEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var CastesEntity $castes */
        foreach (self::getAllActives() as $castes) {
            $output[] = HtmlTags::Option()->Value("$castes->caste_id")->Content($castes->caste_name);
        }
        return implode('', $output);
    }
}