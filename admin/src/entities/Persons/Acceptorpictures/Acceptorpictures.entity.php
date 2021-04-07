<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class AcceptorpicturesEntity extends EntityScheme {
    public $acceptor_photo_id;
    public $acceptor_photo_name;
    public $acceptor_photo_image;
    public $provider_branch_id;
    public $acceptor_photo_description;

    public function model() {
        return new \model\Acceptorpictures();
    }



    protected function dictionary(): array {
        return  [
            'acceptor_photo_id' => 'acceptor_photo_id', 'acceptor_photo_name' => 'acceptor_photo_name', 'acceptor_photo_image' => 'acceptor_photo_image','provider_branch_id' => 'provider_branch_id','acceptor_photo_description' => 'acceptor_photo_description',
        ];
    }
}
