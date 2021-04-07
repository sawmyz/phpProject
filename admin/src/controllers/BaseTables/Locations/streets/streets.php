<?php
namespace controller;
use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CitiesEntity;
use model\Entity\DistrictsEntity;
use model\Entity\StatesEntity;

class streets extends ControllerScheme {
    const name = 'خیابان';


    public function getDistrictInRange() {
        $districtId = $this->requestArray()['Range_id'];
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        foreach ($this->districtByCityId($districtId) as $streets) {
            if (isActive($this, $streets)) {
                $output[] = HtmlTags::Option()->Value($streets->streets_id)->Content($streets->name);
            }
        }
        return implode('', $output);
    }

    private function streetstByRangeId($streetsId) {
        $output = [];
        foreach ($this->model()::getAllFiltered('Range_id', "$streetsId") as $streets) {
            if (!($streets instanceof streetsEntity)){
                $streets = streetsEntity::fromArray((array)$streets);
            }
            $output[] = $streets;
        }
        return $output;
    }
    public function getActiveCities() {
        $output = [];
        foreach ($this->model()::getAllActives() as $streets){
            /** @var DistrictsEntity $streets*/
            $output[] = $streets;
        }
        return $output;
    }

}