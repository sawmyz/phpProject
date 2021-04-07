<?php
namespace controller;
use ControllerScheme;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CountriesEntity;
use model\Entity\DistrictsEntity;
use Api\ApiInterface;

class Countries extends ControllerScheme {
    const name = 'کشور';
    use ApiInterface ;

    public function All(){
       $test= $this->model()::getAll();
       return $test ;

    }






}

