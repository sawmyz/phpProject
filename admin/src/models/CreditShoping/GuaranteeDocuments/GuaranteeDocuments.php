<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeDocuments  extends Model {
    public $_table = 'tblGuaranteeDocuments';
    public $_key = 'guarantee_documents_id';
    public $_Entity =  \model\Entity\GuaranteeDocumentsEntity::class;


    public static function toOption()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var GuaranteeDocumentsEntity $document  */
        foreach (self::getAll() as $document) {
            $name = Individuals::get(Customers::get($document->customer_id)->individual_id);
            $output[] = HtmlTags::Option()->Value("$document->guarantee_documents_id")->Content($document->credit_file_filenumber . ' - ' . $name->first_name . ' ' . $name->last_name)
            ->Data_('customer_id',$document->customer_id)
                ->Data_('name',$name->first_name)

            ;
        }
        return implode('', $output);
    }

    public static function toOptionConfirm()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var GuaranteeDocumentsEntity $document  */
        foreach (self::getAllFiltered('guarantee_documents_status', 1) as $document) {
            $name = Individuals::get(Customers::get($document->customer_id)->individual_id);
            $output[] = HtmlTags::Option()->Value("$document->guarantee_documents_id")->Content($document->credit_file_filenumber . ' - ' . $name->first_name . ' ' . $name->last_name)
                ->Data_('customer_id',$document->customer_id);
        }
        return implode('', $output);
    }


    public static function toOptionConfirmSend()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var GuaranteeDocumentsEntity $document  */
        foreach (self::getAllFiltered('guarantee_documents_status', 3) as $document) {
            $name = Individuals::get(Customers::get($document->customer_id)->individual_id);
            $output[] = HtmlTags::Option()->Value("$document->guarantee_documents_id")->Content($document->credit_file_filenumber . ' - ' . $name->first_name . ' ' . $name->last_name)
                ->Data_('customer_id',$document->customer_id);
        }
        return implode('', $output);
    }

    public static function toOptionNotComplete()
    {
        $output = [HtmlTags::Option()->Disabled()->Selected()->Content("لطفا یک مورد را انتخاب کنید")];
        /** @var GuaranteeDocumentsEntity $document  */
        foreach (self::getAllFiltered('guarantee_documents_status', 0) as $document) {
            $name = Individuals::get(Customers::get($document->customer_id)->individual_id);
            $output[] = HtmlTags::Option()->Value("$document->guarantee_documents_id")->Content($document->credit_file_filenumber . ' - ' . $name->first_name . ' ' . $name->last_name)
                ->Data_('customer_id',$document->customer_id);
        }
        return implode('', $output);
    }
}