<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\EducationsEntity;

class Educations  extends Model {
    public $_table = 'tblEducations';
    public $_key = 'education_id';
    public $_Entity =  \model\Entity\EducationsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var EducationsEntity $education */
        foreach (self::getAll() as $education) {
            $output[] = HtmlTags::Option()->Value("$education->education_id")->Content($education->education_name);
        }
        return implode('', $output);
    }
}