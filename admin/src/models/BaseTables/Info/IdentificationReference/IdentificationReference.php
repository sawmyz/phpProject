<?php

namespace model;

use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IdentificationReferenceEntity;

class IdentificationReference extends Model
{
    public $_table = 'tblIdentificationReference';
    public $_key = 'identification_reference_id';
    public $_Entity = \model\Entity\IdentificationReferenceEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var IdentificationReferenceEntity $identification_reference */
        foreach (self::getAll() as $identification_reference) {
            $output[] = HtmlTags::Option()->Value("$identification_reference->identification_reference_id")->Content($identification_reference->identification_reference_name);
        }
        return implode('', $output);
    }
}