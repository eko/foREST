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
 * Route
 */
class Route
{
    /**
     * Route name
     * @var string
     */
    public $name = null;
    
    /**
     * Route description
     * @var string
     */
    public $description = null;
    
    /**
     * Route resource
     * @var string
     */
    public $resource = null;
    
    /**
     * Route action/method
     * @var string
     */
    public $action = null;
    
    /**
     * Route parameters (required/optionals)
     * @var string
     */
    public $parameters = array();
    
    /**
     * Constructor
     * 
     * @param string $name
     * @param array $route
     */
    public function __construct($name, $route = null) {
        $this->name = $name;
        
        if (null !== $route) {
            $this->setFromArray($route);
        }
    }
    
    /**
     * Return route name
     * 
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set route name
     * 
     * @param string $name
     * 
     * @return string $name
     */
    public function setName($name) {
        return $this->name = $name;
    }
    
    /**
     * Return route description
     * 
     * @return string $description
     */
    public function getDescription() {
        return $this->description;
    }
    
    /**
     * Set route description
     * 
     * @param string $description
     * 
     * @return string $description
     */
    public function setDescription($description) {
        return $this->description = $description;
    }
    
    /**
     * Return route resource
     * 
     * @return string $resource
     */
    public function getResource() {
        return $this->resource;
    }
    
    /**
     * Set route resource
     * 
     * @param string $resource
     * 
     * @return string $resource
     */
    public function setResource($resource) {
        return $this->resource = $resource;
    }
    
    /**
     * Return route action
     * 
     * @return string $action
     */
    public function getAction() {
        return $this->action;
    }
    
    /**
     * Set route action
     * 
     * @param string $action
     * 
     * @return string $action
     */
    public function setAction($action) {
        return $this->action = $action;
    }
    
    /**
     * Return route parameters
     * 
     * @return array $parameters
     */
    public function getParameters() {
        return $this->parameters;
    }
    
    /**
     * Set route parameters
     * 
     * @param array $parameters
     * 
     * @return array $parameters
     */
    public function setParameters(array $parameters) {
        return $this->parameters = $parameters;
    }
    
    /**
     * Set object properties by array
     * 
     * @param array $route
     */
    public function setFromArray(array $route) {
        $route = array_shift($route);
        
        foreach ($route as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
