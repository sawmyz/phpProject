<?php
namespace model;
use DATABASE\Model;
class Acceptorpictures  extends Model {
    public $_table = 'tblAcceptorpictures';
    public $_key = 'acceptor_photo_id';
    public $_Entity =  \model\Entity\AcceptorpicturesEntity::class;
}