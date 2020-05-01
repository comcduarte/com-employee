<?php
namespace Employee\Controller\Factory;

use Employee\Controller\DepartmentController;
use Employee\Form\DepartmentForm;
use Employee\Model\DepartmentModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DepartmentControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new DepartmentController();
        
        $adapter = $container->get('employee-model-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new DepartmentModel($adapter);
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(DepartmentForm::class);
        $form->setDbAdapter($adapter);
        $controller->setForm($form);
        return $controller;
    }
}