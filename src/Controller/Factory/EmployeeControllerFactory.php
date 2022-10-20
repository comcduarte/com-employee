<?php
namespace Employee\Controller\Factory;

use Employee\Controller\EmployeeController;
use Employee\Form\EmployeeForm;
use Employee\Model\EmployeeModel;
use Psr\Container\ContainerInterface;

class EmployeeControllerFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new EmployeeController();
        
        $adapter = $container->get('employee-model-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new EmployeeModel($adapter);
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(EmployeeForm::class);
        $controller->setForm($form);
        return $controller;
    }
}