<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeGuarantorChecksEntity;

class GuaranteeGuarantorChecks  extends Model {
    public $_table = 'tblGuaranteeGuarantorChecks';
    public $_key = 'guarantee_guarantor_check_id';
    public $_Entity =  \model\Entity\GuaranteeGuarantorChecksEntity::class;

}