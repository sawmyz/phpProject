<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeGuarantorRightsCertificatesEntity;

class GuaranteeGuarantorRightsCertificates  extends Model {
    public $_table = 'tblGuaranteeGuarantorRightsCertificates';
    public $_key = 'guarantee_guarantor_rights_certificate_id';
    public $_Entity =  \model\Entity\GuaranteeGuarantorRightsCertificatesEntity::class;

}