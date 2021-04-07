<?php
namespace model;
use DATABASE\Model;
use model\Entity\CreditFileEntity;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\CustomersEntity;

class Customers  extends Model {
    public $_table = 'tblCustomers';
    public $_key = 'customer_id';
    public $_Entity =  \model\Entity\CustomersEntity::class;

    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var IndividualsEntity $individual */
        /** @var CustomersEntity $customer */
        foreach (self::getAll() as $customer) {
            $individual = Individuals::get($customer->individual_id);

            $output[] = HtmlTags::Option()->Value($customer->customer_id)
                ->Content($individual->first_name . ' ' . $individual->last_name . ' - ' . $individual->mobile);

        }
        return implode('', $output);
    }
	
	public static function noCreditFileToOption() {
		$output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
		/** @var IndividualsEntity $individual */
		/** @var CustomersEntity $customer */
		foreach (self::getAll() as $customer) {
			if (!(CreditFile::getOneFiltered("customer_id",$customer->customer_id) instanceof CreditFileEntity)) {
				$individual = Individuals::get($customer->individual_id);
				$output[] = HtmlTags::Option()->Value($customer->customer_id)
					->Content($individual->first_name . ' ' . $individual->last_name . ' - ' . $individual->mobile);
			}
		}
		return implode('', $output);
	}
}
