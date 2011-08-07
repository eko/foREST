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
     * Execute a new query
     * 
     * @param string $key
     * 
     * @return array $result
     */
    public function query($key) {
        return array();
    }
}
?>
