<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteePromissoryEntity;

class GuaranteePromissory  extends Model {
    public $_table = 'tblGuaranteePromissory';
    public $_key = 'guarantee_promissory_id';
    public $_Entity =  \model\Entity\GuaranteePromissoryEntity::class;

}