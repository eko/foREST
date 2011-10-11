<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Database,
    Forest\Core\Exception;

/**
 * Resource
 */
class Resource extends Abstraction {
    /**
     * Databases objects
     * @var array
     */
    private $databases = array();
    
    /**
     * Execute a new query
     * 
     * @param string $key
     * 
     * @return array $result
     */
    public function query($key) {
        $queries = Registry::get('queries');
        
        if (!isset($queries[$key])) {
            throw new Exception(500, sprintf('Query %s does not exists.', $key));
        }
        
        $query = $queries[$key];
        $dbname = $query->getDatabase();
        
        $database = $this->getFromDatabases($dbname);
        
        $result = $database->executeQuery($query->getQuery());
        
        return $result;
    }
    
    /**
     * Return database object
     *
     * @param string $name
     *
     * @return Database $database
     */
    private function getFromDatabases($name) {
        $database = null;
        
        $databases = Registry::get('databases');
        
        if (!isset($databases[$name])) {
            throw new Exception(500, sprintf('Database %s does not exists.', $name));
        }
        
        if (isset($this->databases[$name])) {
            $database = $this->databases[$name];
        } else {
            $database = new Database($databases[$name]);
        }
        
        return $database;
    }
}