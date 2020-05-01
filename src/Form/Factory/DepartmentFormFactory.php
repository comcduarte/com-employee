<?php
namespace Employee\Form\Factory;

use Employee\Form\DepartmentForm;
use Employee\Model\DepartmentModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DepartmentFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new DepartmentForm();
        $adapter = $container->get('employee-model-adapter');
        
        $model = new DepartmentModel($adapter);
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($adapter);
        return $form;
    }
}