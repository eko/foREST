<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

/**
 * Request
 */
class Request
{
    /**
     * HTTP Method
     * @var string
     */
    public $_method = null;
    
    /**
     * HTTP Parameters
     * @var array
     */
    public $_parameters = array();
    
    /**
     * HTTP Protocol
     * @var string
     */
    public $_protocol = null;
    
    /**
     * HTTP URI
     * @var string
     */
    public $_uri = null;
    
    /**
     * Return HTTP Method
     * 
     * @return string $_method
     */
    public function getMethod() {
        return $this->_method;
    }
    
    /**
     * Return HTTP Parameters
     * 
     * @return string $_parameters
     */
    public function getParameters() {
        return $this->_parameters;
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
        
        if (true === isset($this->_parameters[$key])) {
            $value = $this->_parameters[$key];
        }
        
        return $value;
    }
    
    /**
     * Return HTTP Protocol
     * 
     * @return string $_protocol
     */
    public function getProtocol() {
        return $this->_protocol;
    }
    
    /**
     * Return HTTP Uri
     * 
     * @return string $_uri
     */
    public function getUri() {
        return $this->_uri;
    }
    
    /**
     * Analyze and collect request data
     */
    public function analyze() {
        if (true === isset($_SERVER['REQUEST_METHOD'])) {
            $this->_method = $_SERVER['REQUEST_METHOD'];
        }
        
        if (true === isset($_SERVER['REQUEST_URI'])) {
            $this->_uri = $_SERVER['REQUEST_URI'];
        }
        
        if (true === isset($_SERVER['SERVER_PROTOCOL'])) {
            $this->_protocol = $_SERVER['SERVER_PROTOCOL'];
        }
        
        switch ($this->_method) {
            case 'DELETE':
                $this->_parameters = null; //@todo
                break;
            
            case 'GET':
                $this->_parameters = $_GET;
                break;
            
            case 'HEADER':
                $this->_parameters = null; //@todo
                break;
            
            case 'POST':
                $this->_parameters = $_POST;
                break;
            
            case 'PUT':
                $this->_parameters = null; //@todo
                break;
        }
    }
}
?>
