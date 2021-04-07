<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\BanksEntity;

class Banks  extends Model {
    public $_table = 'tblBanks';
    public $_key = 'bank_id';
    public $_Entity =  \model\Entity\BanksEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var BanksEntity $bank */
        foreach (self::getAll() as $bank) {
            $output[] = HtmlTags::Option()->Value("$bank->bank_id")->Content($bank->bank_name);
        }
        return implode('', $output);
    }
}