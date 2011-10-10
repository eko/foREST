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
     * @var object $instance
     */
    private static $instance = null;
    
    /**
     * Set class singleton instance
     *
     * @param object $instance
     */
    protected static function setSingleton($instance) {
        self::$instance = $instance;
    }
    
    /**
     * Singleton design pattern
     * 
     * @return mixed
     */
    public static function singleton() {
        if (null === self::$instance) {
            $class = get_called_class();
            self::$instance = new $class();
        }
        
        return self::$instance;
    }
}
