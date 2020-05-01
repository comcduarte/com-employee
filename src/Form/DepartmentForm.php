<?php
namespace Employee\Form;

use Components\Form\AbstractBaseForm;
use Components\Form\Element\DatabaseSelect;
use Laminas\Db\Adapter\AdapterAwareTrait;
use Laminas\Form\Element\Text;

class DepartmentForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Department Code',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'NAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'NAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Department Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'PARENT',
            'type' => DatabaseSelect::class,
            'attributes' => [
                'id' => 'PARENT',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Parent Department',
                'database_adapter' => $this->adapter,
                'database_table' => 'departments',
                'database_id_column' => 'UUID',
                'database_value_columns' => [
                    'NAME',
                ],
            ],
        ],['priority' => 100]);
        
    }
}