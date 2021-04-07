<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class DegreesEntity extends EntityScheme {
    public $degree_id;
public $name;

public $minim;

public $max;


    public function model() {
        return new \model\Degrees();
    }



    protected function dictionary(): array {
        return  [
            'id' => 'degree_id','name' => 'degree_name','minim' => 'degree_minim','max' => 'degree_max',
        ];
    }
}
