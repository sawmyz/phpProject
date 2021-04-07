<?php

namespace controller;

use ControllerScheme;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\CustomersEntity;
use model\Entity\SupervisorsEntity;

class Supervisors extends ControllerScheme
{
    const name = 'سرپرست';

//    public function showInOption(object $item): string
//    {
//        return HtmlTags::Option()->Value($item->individual_id)->Content("$item->first_name $item->last_name - $item->mobile")->Selected();
//    }
//
//    public function checkUnique_individual_mobile()
//    {
//        header('Content-Type: application/json');
//        $individual_mobile = $this->requestArray()['individual_mobile'];
//        $state = $this->requestArray()['currentState'];
//        if ($state == 'add' or !$state) {
//            $customer = \model\Supervisors::getOneFiltered("individual_mobile", CorrectMobile($individual_mobile));
//            if ($customer instanceof IndividualsEntity) {
//                return json_encode(['status' => false, "message" => "شماره موبایل وارد شده قبلا در سیستم ثبت شده است"]);
//            }
//        }
//        return json_encode(['status' => true]);
//    }
}
