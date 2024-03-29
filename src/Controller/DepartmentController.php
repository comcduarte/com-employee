<?php
namespace Employee\Controller;

use Components\Controller\AbstractBaseController;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Predicate\Like;
use Laminas\View\Model\ViewModel;

class DepartmentController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        $view->setTemplate('base/subtable');
        
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->from('departments');
        $select->columns([
            'UUID' => 'UUID',
            'Code' => 'CODE',
            'Department Name' => 'NAME',
        ]);
        $select->where(['departments.STATUS' => $this->model::ACTIVE_STATUS]);
        $select->order('NAME ASC');
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $resultSet = new ResultSet($results);
        $resultSet->initialize($results);
        $data = $resultSet->toArray();
        
        $header = [];
        if (!empty($data)) {
            $header = array_keys($data[0]);
        }
        
        $params = [
            [
                'route' => 'department/default',
                'action' => 'update',
                'key' => 'UUID',
                'label' => 'Update',
            ],
            [
                'route' => 'department/default',
                'action' => 'delete',
                'key' => 'UUID',
                'label' => 'Delete',
            ],
        ];
        
        $view->setvariables ([
            'data' => $data,
            'header' => $header,
            'primary_key' => $this->model->getPrimaryKey(),
            'params' => $params,
            'search' => true,
            'title' => 'Departments',
        ]);
        
        return $view;
    }
    
    public function updateAction()
    {
        $view = new ViewModel();
        $view = parent::updateAction();
        
        /****************************************
         * EMPLOYEES SUBTABLE
         ****************************************/
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->columns(['UUID', 'LNAME', 'FNAME'])
            ->from('employees')
            ->where([new Like('DEPT', $this->model->UUID)]);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        
        $results = $statement->execute();
        $resultSet = new ResultSet($results);
        $resultSet->initialize($results);
        $employees = $resultSet->toArray();
        
        $view->setVariable('employees', $employees);
        return $view;
    }
}