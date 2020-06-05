<?php
namespace Employee\Form;

use Components\Form\AbstractBaseForm;
use Components\Form\Element\DatabaseSelect;
use Laminas\Db\Adapter\AdapterAwareTrait;
use Laminas\Form\Element\Text;

class EmployeeForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'EMP_NUM',
            'type' => Text::class,
            'attributes' => [
                'id' => 'EMP_NUM',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Employee Number',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'FNAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'FNAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'First Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'LNAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'LNAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Last Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'EMAIL',
            'type' => Text::class,
            'attributes' => [
                'id' => 'EMAIL',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Email Address',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DEPT',
            'type' => DatabaseSelect::class,
            'attributes' => [
                'id' => 'DEPT',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Department',
                'database_adapter' => $this->adapter,
                'database_table' => 'departments',
                'database_id_column' => 'UUID',
                'database_value_columns' => [
                    'NAME',
                ],
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'POSITION',
            'type' => Text::class,
            'attributes' => [
                'id' => 'POSITION',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Position',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'POSITION_DESC',
            'type' => Text::class,
            'attributes' => [
                'id' => 'POSITION_DESC',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Position Description',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'GRADE_SCHEDULE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'GRADE_SCHEDULE',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Grade Schedule',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'GRADE_SCHEDULE_DESC',
            'type' => Text::class,
            'attributes' => [
                'id' => 'GRADE_SCHEDULE_DESC',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Grade Schedule Description',
            ],
        ],['priority' => 100]);
    }
}