<?php
namespace Employee\Model;

use Components\Model\AbstractBaseModel;

class DepartmentModel extends AbstractBaseModel
{
    public $CODE;
    public $NAME;
    public $PARENT;
    
    public function __construct($adapter = NULL)
    {
        parent::__construct($adapter);
        $this->setTableName('departments');
    }
}