<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CitiesEntity;
class Cities  extends Model {
    public $_table = 'tblCities';
    public $_key = 'city_id';
    public $_Entity =  \model\Entity\CitiesEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var CitiesEntity $city */
        foreach (self::getAllActives() as $city) {
            $output[] = HtmlTags::Option()->Value("$city->city_id")->Content($city->city_name);
        }
        return implode('', $output);
    }
    
}