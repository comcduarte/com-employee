<?php
namespace Employee\Model;

use Components\Model\AbstractBaseModel;

class EmployeeModel extends AbstractBaseModel
{
    public $FNAME;
    public $LNAME;
    public $EMAIL;
    public $EMP_NUM;
    public $DEPT;
    public $TIME_GROUP;
    public $TIME_SUBGROUP;
    public $POSITION;
    public $POSITION_DESC;
    public $GRADE_SCHEDULE;
    public $GRADE_SCHEDULE_DESC;
    
    public function __construct($adapter = NULL)
    {
        parent::__construct($adapter);
        $this->setTableName('employees');
    }
}