<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use PDO,
    Forest\Core\Exception;

/**
 * Database
 */
class Database
{
    /**
     * Database dsn string
     * @var string
     */
    private $dsn = null;
    
    /**
     * Database username
     * @var string
     */
    private $username = null;
    
    /**
     * Database password
     * @var string
     */
    private $password = null;
    
    /**
     * PDO object
     * @var PDO
     */
    private $pdo = null;
    
    /**
     * Constructor
     * 
     * @param array $data
     */
    public function __construct($data = null) {
        if (null !== $data) {
            $this->setFromArray($data);
        }
        
        $this->pdo = $this->getConnection();
    }
    
    /**
     * Set object properties from array
     * 
     * @param array $data
     */
    public function setFromArray(array $data) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
    
    /**
     * Connect to database
     *
     * @return PDO object
     */
    public function getConnection() {
        $pdo = null;
        
        if (null === $this->pdo) {
            $pdo = new PDO($this->dsn, $this->username, $this->password, array(PDO::ATTR_PERSISTENT => true));
        }
        
        return $pdo;
    }
    
    /**
     * Execute specified query
     *
     * @param string $query
     *
     * @return array $result
     */
    public function executeQuery($query) {
        $statement = $this->pdo->prepare($query);
        
        if (!$statement->execute()) {
            $infos = $statement->errorInfo();
            $message = isset($infos[2]) ? $infos[2] : 'no info';
            
            throw new Exception(sprintf('Error - Query: %s', $message), 500);
        }
        
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($result)) {
            throw new Exception('No result', 204);
        }
        
        return $result;
    }
}