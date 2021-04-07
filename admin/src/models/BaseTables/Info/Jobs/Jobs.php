<?php
namespace model;
use DATABASE\Model;
class Jobs  extends Model {
    public $_table = 'tblJobs';
    public $_key = 'job_id';
    public $_Entity =  \model\Entity\JobsEntity::class;
}