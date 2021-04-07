<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\ContractTypesEntity;

class ContractTypes  extends Model {
    public $_table = 'tblContractTypes';
    public $_key = 'contracttype_id';
    public $_Entity =  \model\Entity\ContractTypesEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var ContractTypesEntity $contractypes */
        foreach (self::getAllActives() as $contractypes) {
            $output[] = HtmlTags::Option()->Value("$contractypes->contracttype_id")->Content($contractypes->contract_type_name);
        }
        return implode('', $output);
    }

}