<?php

namespace model;

use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\CreditFileEntity;


class CreditFile extends Model
{
    public $_table = 'tblCreditFile';
    public $_key = 'credit_file_id';
    public $_Entity = \model\Entity\CreditFileEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var CreditFileEntity $creditfile */
        foreach (self::getAll() as $creditfile) {
            
           $customer = Customers::get($creditfile->customer_id)->individual_id;
           $name = Individuals::get($customer);

            $output[] = HtmlTags::Option()->Value("$creditfile->credit_file_id")->Content($creditfile->credit_file_filenumber.' - '.$name->individual_first_name .' '.$name->individual_last_name )
            ->Data_('price' , $creditfile->credit_file_payment_amount)
                ->Data_('name',$name->first_name)
            ->Data_('last_name' , $name->individual_last_name);
        }
        return implode('', $output);
    }

}