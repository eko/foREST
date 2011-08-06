<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace foRest\Core;

/**
 * Bootstrap application
 */
class Bootstrap
{
    /**
     * Constructor
     */
    public function __construct() {
        spl_autoload_register(__CLASS__ .'::autoload');
    }
    
    /**
     * Autoload all class in project
     * @param string $class
     */
    public static function autoload($class) {
        include 'src/' . str_replace(array('_', '\\'), '/', $class) . '.php';
    }
}
?>