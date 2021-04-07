<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CountriesEntity;

class Countries  extends Model {
    public $_table = 'tblCountries';
    public $_key = 'country_id';
    public $_Entity =  \model\Entity\CountriesEntity::class;

    public static function toOption()
    {
        $output = [
//        	HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")
        ];
        /** @var CountriesEntity $allActive */
        foreach (self::getAllActives() as $allActive) {
            $output[] = HtmlTags::Option()->Value("$allActive->country_id")->Content($allActive->country_name) ;
        }

        return implode('', $output);
    }
}
