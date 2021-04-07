<?php
namespace controller;
use ControllerScheme;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\ProviderBranchesEntity;

class ProviderBranches extends ControllerScheme {
    const name = 'شعبه ی پذیرنده';

public static $__uploads = ["provider_branch_image" => __SOURCE__."images/ProviderBranches/"];


//    public function getProviderBranchesInProvider() {
//        $providerId = $this->requestArray()['provider_id'];
////        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
//        $output = [];
//        foreach ($this->ProviderBranchesByProviderId($providerId) as $providerBranch) {
//            if (isActive($this,$providerBranch)) {
//                $output[] = HtmlTags::Option()->Value($providerBranch->provider_branch_id)->Content($providerBranch->provider_branch_name);
//            }
//        }
//        return implode('', $output);
//    }
//
//    private function ProviderBranchesByProviderId($providerId) {
//        $output = [];
//        foreach ($this->model()::getAllFiltered('provider_id', "$providerId") as $providerBranch) {
//            if (($providerBranch instanceof ProviderBranchesEntity)){
//                $output[] = ProviderBranchesEntity::fromArray((array)$providerBranch);
//            }
//        }
//        return $output;
//    }
//
//    public function getActiveProviderBranches() {
//        $output = [];
//        foreach ($this->model()::getAllActives() as $providerBranch){
//            /** @var ProviderBranchesEntity $providerBranch */
//            $output[] = $providerBranch;
//        }
//        return $output;
//    }
//

}