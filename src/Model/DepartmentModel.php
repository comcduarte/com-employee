<?php
namespace Employee\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Db\Sql\Where;

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
    
    public function getEmployees()
    {
        if (is_null($this->CODE)) {
            throw new \Exception('Department CODE not specified.  Unable to retrieve list of employees.');
        }
        
        $employee = new EmployeeModel($this->adapter);
        
        $employee->getSelect()->columns(['UUID']);
        
        $predicate = new Where();
        $predicate->equalTo('DEPT', $this->UUID);
        
        $employees = $employee->fetchAll($predicate);
        
        return $employees;
    }
}