<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeBirthCertificate  extends Model {
    public $_table = 'tblGuaranteeBirthCertificate';
    public $_key = 'guarantee_birth_certificate_id';
    public $_Entity =  \model\Entity\GuaranteeBirthCertificateEntity::class;

}