<?php
namespace Employee;

class Module
{
    const VERSION = "v1.0.1";
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}