<?php

namespace model;

use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;

class Individuals extends Model
{
    public $_table = 'tblIndividuals';
    public $_key = 'individual_id';
    public $_Entity = IndividualsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var IndividualsEntity $individual */
        foreach (self::getAll() as $individual) {
            $output[] = HtmlTags::Option()->Value($individual->individual_id)->Content($individual->first_name . ' ' . $individual->last_name . ' - ' . $individual->mobile);
        }
        return implode('', $output);
    }

}