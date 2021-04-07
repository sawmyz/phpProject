<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class IdentificationReferenceEntity extends EntityScheme
{
    public $_id;
    public $name;


    public function model()
    {
        return new \model\IdentificationReference();
    }


    protected function dictionary(): array
    {
        return [
            'id' => 'identification_reference_id', 'name' => 'identification_reference_name',
        ];
    }
}
