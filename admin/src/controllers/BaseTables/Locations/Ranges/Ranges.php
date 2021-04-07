<?php
namespace controller;
use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\DistrictsEntity;
use model\Entity\RangesEntity;

class Ranges extends ControllerScheme {
    const name = 'محدوده';


    public function getRangeInDistrict() {
        $districtId = $this->requestArray()['district_id'];
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        foreach ($this->rangeBydistrictId($districtId) as $range) {
            if (isActive($this,$range)) {
                $output[] = HtmlTags::Option()->Value($range->range_id)->Content($range->Range_name);
            }
        }
        return implode('', $output);
    }
    private function rangeBydistrictId($districtId) {
        $output = [];
        foreach ($this->model()::getAllFiltered('district_id', "$districtId") as $range) {
            if (!($range instanceof DistrictsEntity)){
                $range = RangesEntity::fromArray((array)$range);
            }
            $output[] = $range;
        }
        return $output;
    }

}