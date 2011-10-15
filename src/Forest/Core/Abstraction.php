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
abstract class Abstraction {
    /**
     * Singleton design pattern
     * 
     * @return mixed
     */
    public static function singleton() {
        static $instance = null;
        
        if (null === $instance) {
            $instance = new static();
        }
        
        return $instance;
    }
}
