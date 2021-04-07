<?php

namespace controller;

use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CitiesEntity;

class Cities extends ControllerScheme
{
    const name = 'شهر';

    public function getCityInState()
    {
        $stateId = $this->requestArray()['state_id'];
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        foreach ($this->cityByStateId($stateId) as $city) {
            if (isActive($this, $city)) {
                $output[] = HtmlTags::Option()->Value($city->city_id)->Content($city->name);
            }
        }
        return implode('', $output);
    }

    private function cityByStateId($cityId)
    {
        $output = [];
        foreach ($this->model()::getAllFiltered('state_id', "$cityId") as $city) {
            if (!($city instanceof CitiesEntity)) {
                $city = CitiesEntity::fromArray((array)$city);
            }
            $output[] = $city;
        }
        return $output;
    }

    public function getActiveCities()
    {
        $output = [];
        foreach ($this->model()::getAllActives() as $city) {
            /** @var CitiesEntity $city */
            $output[] = $city;
        }
        return $output;
    }
}