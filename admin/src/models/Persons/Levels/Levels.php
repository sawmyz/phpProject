<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\LevelsEntity;

class Levels  extends Model {
    public $_table = 'tblLevels';
    public $_key = 'level_id';
    public $_Entity =  \model\Entity\LevelsEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var LevelsEntity $level */
        foreach (self::getAllActives() as $level) {
            $output[] = HtmlTags::Option()->Value("$level->level_id")->Content($level->title);
        }
        return implode('', $output);
    }

}