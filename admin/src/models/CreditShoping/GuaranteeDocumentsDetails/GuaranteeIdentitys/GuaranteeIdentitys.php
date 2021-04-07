<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeIdentityssEntity;

class GuaranteeIdentitys  extends Model {
    public $_table = 'tblGuaranteeIdentitys';
    public $_key = 'guarantee_Identity_id';
    public $_Entity =  \model\Entity\GuaranteeIdentitysEntity::class;

}