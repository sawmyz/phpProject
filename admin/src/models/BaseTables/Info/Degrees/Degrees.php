<?php
namespace model;
use DATABASE\Model;
class Degrees  extends Model {
    public $_table = 'tblDegrees';
    public $_key = 'degree_id';
    public $_Entity =  \model\Entity\DegreesEntity::class;
}