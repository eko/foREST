<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Resource
 */
class Resource extends Abstraction {
    
    /**
     * Set a new property entry in registry
     * @param string $key
     * @param mixed $value
     * @return mixed $value
     */
    public function setProperty($key, $value) {
        self::$_registry[$key] = $value;
        
        return $value;
    }
}
?>
