<?php
namespace model;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;

class SendDocuments  extends Model {
    public $_table = 'tblSendGuaranteeDocuments';
    public $_key = 'send_guarantee_documents_id';
    public $_Entity =  \model\Entity\SendDocumentsEntity::class;

}