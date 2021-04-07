<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\RangesEntity;

class Ranges  extends Model {
    public $_table = 'tblRanges';
    public $_key = 'range_id';
    public $_Entity =  \model\Entity\RangesEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var RangesEntity $range */
        foreach (self::getAllActives() as $range) {
            $output[] = HtmlTags::Option()->Value("$range->range_id")->Content($range->range_name);
        }
        return implode('', $output);
    }
}