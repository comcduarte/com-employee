<?php
namespace Employee;

class Module
{
    const TITLE = "Employee Module";
    const VERSION = "v1.0.6";
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}