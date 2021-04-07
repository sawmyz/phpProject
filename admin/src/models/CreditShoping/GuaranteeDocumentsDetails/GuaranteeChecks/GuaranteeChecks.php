<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeChecks  extends Model {
    public $_table = 'tblGuaranteeChecks';
    public $_key = 'guarantee_check_id';
    public $_Entity =  \model\Entity\GuaranteeChecksEntity::class;

}