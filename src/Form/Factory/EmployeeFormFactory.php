<?php
namespace Employee\Form\Factory;

use Employee\Form\EmployeeForm;
use Employee\Model\EmployeeModel;
use Interop\Container\ContainerInterface;

class EmployeeFormFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new EmployeeForm();
        $adapter = $container->get('employee-model-adapter');
        
        $model = new EmployeeModel($adapter);
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($adapter);
        return $form;
    }
}