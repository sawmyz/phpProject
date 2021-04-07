<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GrantPurchaseCreditsEntity;

class GrantPurchaseCredits  extends Model {
    public $_table = 'tblGrantPurchaseCredits';
    public $_key = 'grant_purchase_credit_id';
    public $_Entity =  \model\Entity\GrantPurchaseCreditsEntity::class;

    
}