<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Exception as Exception;

/**
 * Request
 */
class Request
{
    /**
     * HTTP Method
     * @var string
     */
    public $method = null;
    
    /**
     * HTTP Parameters
     * @var array
     */
    public $parameters = array();
    
    /**
     * HTTP Protocol
     * @var string
     */
    public $protocol = null;
    
    /**
     * HTTP URI
     * @var string
     */
    public $uri = null;
    
    /**
     * Mapping route
     * @var string
     */
    public $route = null;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->analyze();
    }
    
    /**
     * Magic __call method for getter and setters
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return type mixed
     */
    public function __call($name, $arguments) {
        $value = null;
        
        $action = strtolower(substr($name, 0, 3));
        $method = strtolower(substr($name, 3));
        
        switch ($action) {
            case 'get':
                if (isset($this->{$method})) {
                    $value = $this->{$method};
                }
                break;
            
            case 'set':
                if (1 === count($arguments)) {
                    $this->{$method} = $arguments[0];
                } else {
                    $this->{$method} = $arguments;
                }
                break;
            
            default:
                if (method_exists($this, $name)) {
                    return call_user_method($name, $this, $arguments);
                } else {
                    throw new Exception(sprintf("Undefined method '%s' in class '%s'", $method, __CLASS__));
                }
                break;
        }
        
        return $value;
    }
    
    /**
     * Return specified HTTP Parameter
     * 
     * @param string $key
     * 
     * @return string $value
     */
    public function getParameter($key) {
        $value = null;
        
        if (isset($this->parameters[$key])) {
            $value = $this->parameters[$key];
        }
        
        return $value;
    }
    
    /**
     * Analyze and collect request data
     */
    public function analyze() {
        if (isset($this->uri)) {
            $this->uri = $_SERVER['REQUEST_URI'];
        }
        
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        }
        
        if (isset($_SERVER['REQUEST_URI'])) {
            $this->uri = $_SERVER['REQUEST_URI'];
        }
        
        if (isset($_SERVER['SERVER_PROTOCOL'])) {
            $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        }
        
        switch ($this->method) {
            case 'DELETE':
                $this->parameters = null; //@todo
                break;
            
            case 'GET':
                $this->parameters = $_GET;
                break;
            
            case 'HEADER':
                $this->parameters = null; //@todo
                break;
            
            case 'POST':
                $this->parameters = $_POST;
                break;
            
            case 'PUT':
                $this->parameters = null; //@todo
                break;
        }
    }
}
