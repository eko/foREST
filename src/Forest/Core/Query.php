<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Exception;

/**
 * Query
 */
class Query
{
    /**
     * Query name
     * @var string
     */
    public $name = null;
    
    /**
     * Query database
     * @var string
     */
    public $database = null;
    
    /**
     * Query string
     * @var string
     */
    public $query = null;
    
    /**
     * Constructor
     * 
     * @param string $name
     * @param array $query
     */
    public function __construct($name, $query = null) {
        $this->name = $name;
        
        if (null !== $query) {
            $this->setFromArray($query);
        }
    }
    
    /**
     * Return query name
     * 
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set query name
     * 
     * @param string $name
     * 
     * @return string $name
     */
    public function setName($name) {
        return $this->name = $name;
    }
    
    /**
     * Return query database
     * 
     * @return string $database
     */
    public function getDatabase() {
        return $this->database;
    }
    
    /**
     * Set query database
     * 
     * @param string $database
     * 
     * @return string $database
     */
    public function setDatabase($database) {
        return $this->database = $database;
    }
    
    /**
     * Return query string
     * 
     * @return string $query
     */
    public function getQuery() {
        return $this->query;
    }
    
    /**
     * Set query query
     * 
     * @param string $query
     * 
     * @return string $query
     */
    public function setQuery($query) {
        return $this->query = $query;
    }
    
    /**
     * Set object properties from array
     * 
     * @param array $query
     */
    public function setFromArray(array $query) {
        $query = array_shift($query);
        
        foreach ($query as $key => $value) {
            $this->{$key} = $value;
        }
    }
}