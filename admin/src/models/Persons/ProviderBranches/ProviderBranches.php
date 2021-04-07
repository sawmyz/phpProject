<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;

use model\Entity\ProviderBranchesEntity;

class ProviderBranches  extends Model {
    public $_table = 'tblProviderBranches';
    public $_key = 'provider_branch_id';
    public $_Entity =  \model\Entity\ProviderBranchesEntity::class;
    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var ProviderBranchesEntity $provider_branch */
        foreach (self::getAllActives() as $provider_branch) {
            $output[] = HtmlTags::Option()->Value("$provider_branch->provider_branch_id")->Content($provider_branch->name);
        }
        return implode('', $output);
    }
}