<?php
namespace model;
use DATABASE\Model;
class SocialMedias  extends Model {
    public $_table = 'tblSocialMedias';
    public $_key = 'social_media_id';
    public $_Entity =  \model\Entity\SocialMediasEntity::class;
}