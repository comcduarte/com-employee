<?php
namespace Employee\Form;

use Laminas\Db\Adapter\AdapterAwareTrait;
use Laminas\Form\Form;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;

class FindEmployeeForm extends Form
{
    use AdapterAwareTrait;
    
    public function initialize()
    {
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
        
        $this->add(new Csrf('SECURITY'));
        
        $this->add([
            'name' => 'SUBMIT',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Search',
                'class' => 'btn btn-primary mt-2',
                'id' => 'SUBMIT',
            ],
        ],['priority' => 0]);
    }
}