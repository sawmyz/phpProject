<?php
namespace controller;
use ControllerScheme;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CastesEntity;

class Castes extends ControllerScheme {
    const name = 'اصناف';


    public function getCaseInWorkGroup() {
        $workgroupId = $this->requestArray()['workgroup_id'];
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        foreach ($this->caseByWorkGroupId($workgroupId) as $case) {
            if (isActive($this,$case)) {
                $output[] = HtmlTags::Option()->Value($case->caste_id)->Content($case->caste_name);
            }
        }
        return implode('', $output);
    }

    private function caseByWorkGroupId($caseId) {
        $output = [];
        foreach ($this->model()::getAllFiltered('workgroup_id', "$caseId") as $case) {
            if (!($case instanceof CastesEntity)){
                $case = CastesEntity::fromArray((array)$case);
            }
            $output[] = $case;
        }
        return $output;
    }

}