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
     * Registry
     * @var array $_registry
     */
    private static $_registry = array();
    
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
    
    /**
     * Set a new property entry in registry
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return mixed $value
     */
    public function setProperty($key, $value) {
        self::$_registry[$key] = $value;
        
        return $value;
    }
    
    /**
     * Get property from registry
     * 
     * @param string $key
     * 
     * @return mixed $value
     */
    public function getProperty($key) {
        $value = null;
        
        if (true === isset(self::$_registry[$key])) {
            $value = self::$_registry[$key];
        }
        
        return $value;
    }
}
?>
