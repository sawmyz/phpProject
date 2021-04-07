<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeNationalCardEntity;

class GuaranteeNationalCard  extends Model {
    public $_table = 'tblGuaranteeNationalCard';
    public $_key = 'guarantee_national_card_id';
    public $_Entity =  \model\Entity\GuaranteeNationalCardEntity::class;

}