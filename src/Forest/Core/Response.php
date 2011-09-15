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
 * Response
 */
class Response
{
    /**
     * Response data
     * @var array
     */
    public $data = array();
    
    /**
     * Start duration time
     * @var float
     */
    private $start = 0;

    /**
     * Constructor
     */
    public function __construct() {
        $this->start = microtime(true);
    }

    public function getDuration() {
        return (microtime(true) - $this->start);
    }
    
    /**
     * Return data
     * 
     * @return array $_data
     */
    public function getData() {
        return $this->data;
    }
    
    /**
     * Set response data
     * 
     * @param array $data
     * 
     * @return array $_data
     */
    public function setData($data) {
        $this->data = $data;
    }
    
    /**
     * Set response header
     * 
     * @param string $protocol
     * @param int $code
     * @param string $message
     */
    public function setHeader($protocol, $code, $message) {
        header($protocol . ' ' . $code . ' ' . $message);
    }
    
    /**
     * Render error message
     * 
     * @param int $code
     * @param string $message
     */
    public function renderError($code, $message) {
        $this->setHeader('HTTP/1.1', $code, $message);
        $this->setData($message);
        
        throw new Exception($message, $code);
    }
}
