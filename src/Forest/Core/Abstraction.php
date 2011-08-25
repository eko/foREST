<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Abstract class
 */
class Abstraction {
    /**
     * Instance object
     * @var object $_instance
     */
    private static $_instance = null;
    
    /**
     * Singleton design pattern
     * 
     * @return mixed
     */
    public static function singleton() {
        if (null === self::$_instance) {
            $class = get_called_class();
            self::$_instance = new $class();
        }
        
        return self::$_instance;
    }
}
?>
