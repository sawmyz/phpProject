<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use model\Entity\GuaranteeDocumentsEntity;

class GuaranteeDocumentsConfirm  extends Model {
    public $_table = 'tblGuaranteeDocuments';
    public $_key = 'guarantee_documents_id';
    public $_Entity =  \model\Entity\GuaranteeDocumentsEntity::class;

}