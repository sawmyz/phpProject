<?php
namespace controller;
use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CitiesEntity;
use model\Entity\DistrictsEntity;
use model\Entity\StatesEntity;

class Districts extends ControllerScheme {
    const name = 'منطقه';


//    public function getDistrictInCity()
//    {
//        $city_id = $_POST['city_id'];
//        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
//        $query = FwConnection::conn()->query("SELECT * FROM tblDistricts WHERE city_id='$city_id'")->fetchAll();
//        foreach ($query as $item) {
//            $output[] = HtmlTags::Option()->Value($item['district_id'])->Content($item['district_name']);
//        }
//        return implode('', $output);
//
//    }

    public function getDistrictInCity() {
        $districtId = $this->requestArray()['city_id'];
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        foreach ($this->districtByCityId($districtId) as $district) {
            if (isActive($this,$district)) {
                $output[] = HtmlTags::Option()->Value($district->district_id)->Content($district->name);
            }
        }
        return implode('', $output);
    }

    private function districtByCityId($districtId) {
        $output = [];
        foreach ($this->model()::getAllFiltered('city_id', "$districtId") as $district) {
            if (!($district instanceof DistrictsEntity)){
                $district = DistrictsEntity::fromArray((array)$district);
            }
            $output[] = $district;
        }
        return $output;
    }
    public function getActiveCities() {
        $output = [];
        foreach ($this->model()::getAllActives() as $city){
            /** @var DistrictsEntity $city */
            $output[] = $city;
        }
        return $output;
    }

}