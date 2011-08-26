<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Registry
 */
class Registry {
    /**
     * Registry
     * @var array $_registry
     */
    private static $_registry = array();
    
    /**
     * Set a new property entry in registry
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return mixed $value
     */
    public static function set($key, $value) {
        self::$_registry[$key] = $value;
        
        return $value;
    }
    
    /**
     * Get property from registry
     * 
     * @param string $key
     * @paran string $value
     * 
     * @return mixed $value
     */
    public static function get($key, $value = null) {
        if (isset(self::$_registry[$key])) {
            $value = self::$_registry[$key];
        }
        
        return $value;
    }
}
