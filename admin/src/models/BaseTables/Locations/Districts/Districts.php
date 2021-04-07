<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\DistrictsEntity;

class Districts  extends Model {
    public $_table = 'tblDistricts';
    public $_key = 'district_id';
    public $_Entity =  \model\Entity\DistrictsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var DistrictsEntity $district */
        foreach (self::getAllActives() as $district) {
            $output[] = HtmlTags::Option()->Value("$district->district_id")->Content($district->district_name);
        }
        return implode('', $output);
    }
}