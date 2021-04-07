<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class SocialMediasEntity extends EntityScheme {
    public $social_media_id;
    public $social_media_name;
    public $social_media_icon;
    public $social_media_image;

    public function model() {
        return new \model\SocialMedias();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'social_media_id','social_media_name' => 'social_media_name','social_media_icon' => 'social_media_icon','social_media_image' => 'social_media_image',
        ];
    }
}
