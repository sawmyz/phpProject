<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeCertificateRights  extends Model {
    public $_table = 'tblGuaranteeCertificateRights';
    public $_key = 'guarantee_certificate_rights_id';
    public $_Entity =  \model\Entity\GuaranteeCertificateRightsEntity::class;

}