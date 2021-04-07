<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\CustomersEntity;

class InquiryCustomer  extends Model {
    public $_table = 'tblCreditFile';
    public $_key = 'credit_file_id';
    public $_Entity =  \model\Entity\CreditFileEntity::class;

}