<?php
namespace Employee\Controller\Factory;

use Employee\Controller\EmployeeConfigController;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class EmployeeConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new EmployeeConfigController();
        $adapter = $container->get('employee-model-adapter');
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}