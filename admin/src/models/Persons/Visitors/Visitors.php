<?php

namespace model;

use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CustomersEntity;
use model\Entity\IndividualsEntity;
use model\Entity\VisitorsEntity;

class Visitors extends Model
{
    public $_table = 'tblVisitors';
    public $_key = 'visitor_id';
    public $_Entity = \model\Entity\VisitorsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var IndividualsEntity $individual */
        /** @var CustomersEntity $visitor */
        foreach (self::getAll() as $visitor) {
            $individual = Individuals::get($visitor->individual_id);

            $output[] = HtmlTags::Option()->Value('$visitor->customer_id')
                ->Content($individual->first_name . ' ' . $individual->last_name . ' - ' . $individual->mobile);

        }
        return implode('', $output);
    }

}