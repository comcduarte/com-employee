<?php
namespace Employee\Controller;

use Components\Controller\AbstractBaseController;
use Employee\Form\FindEmployeeForm;
use Employee\Model\EmployeeModel;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Where;
use Laminas\View\Model\ViewModel;
use Exception;

class EmployeeController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        $view->setTemplate('base/subtable');
        
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->from('employees');
        $select->columns([
            'UUID' => 'UUID',
            'First Name' => 'FNAME',
            'Last Name' => 'LNAME',
            'Email' => 'EMAIL',
        ]);
        $select->where(['employees.STATUS' => $this->model::ACTIVE_STATUS]);
        $select->join('departments', 'departments.UUID = employees.DEPT', ['Department' => 'NAME'], Select::JOIN_LEFT);
        $select->order('LNAME ASC');
        
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
                'route' => 'employee/default',
                'action' => 'update',
                'key' => 'UUID',
                'label' => 'Update',
            ],
            [
                'route' => 'employee/default',
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
            'title' => 'Employees',
        ]);
        
        return $view;
    }
    
    public function findAction()
    {
        $view = new ViewModel();
        $view->setTemplate('employee/employee/index');
        
        $model = new EmployeeModel($this->adapter);
        $form = new FindEmployeeForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $data = $request->getPost();
            $form->setData($data);
            
            if ($form->isValid()) {
                $sql = new Sql($this->adapter);
                
                $select = new Select();
                $select->from($model->getTableName());
                $select->columns(['UUID','FNAME','LNAME']);
                $select->order('LNAME DESC');
                
                $search_string = NULL;
                if (stripos($data['LNAME'],'%')) {
                    $search_string = $data['LNAME'];
                } else {
                    $search_string = '%' . $data['LNAME'] . '%';
                }
                
                $predicate = new Where();
                $predicate->like('LNAME', $search_string);
                
                $select->where($predicate);
                $select->order('LNAME');
                
                $statement = $sql->prepareStatementForSqlObject($select);
                $resultSet = new ResultSet();
                
                try {
                    $results = $statement->execute();
                    $resultSet->initialize($results);
                } catch (Exception $e) {
                    return $e;
                }
                
                $employees = $resultSet->toArray();
            }
        }
        
        $header = [];
        if (!empty($data)) {
            $header = array_keys($employees[0]);
        }
        
        $view->setVariable('header', $header);
        $view->setVariable('data', $employees);
        $view->setVariable('primary_key', $model->getPrimaryKey());
        return $view;
    }
}