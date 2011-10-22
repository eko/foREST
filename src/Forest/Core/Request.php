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
     * HTTP Requested format
     * @var string
     */
    public $format = null;
    
    /**
     * Mapping route
     * @var string
     */
    public $route = null;

    /**
     * HTTP user name
     * @var string
     */
    public $user = null;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->analyze();
    }
    
    /**
     * Return HTTP method
     * 
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }
    
    /**
     * Set HTTP method value
     * 
     * @param string $value
     */
    public function setMethod($value) {
        $this->method = $value;
    }
    
    /**
     * Return HTTP parameters
     * 
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }
    
    /**
     * Set HTTP parameters value
     * 
     * @param array $value
     */
    public function setParameters($value) {
        $this->parameters = $value;
    }
    
    /**
     * Return specified HTTP parameter
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
     * Return HTTP protocol
     * 
     * @return string
     */
    public function getProtocol() {
        return $this->protocol;
    }
    
    /**
     * Set HTTP protocol value
     * 
     * @param string $value
     */
    public function setProtocol($value) {
        $this->protocol = $value;
    }
    
    /**
     * Return HTTP URI
     * 
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }
    
    /**
     * Set HTTP URI value
     * 
     * @param string $value
     */
    public function setUri($value) {
        $this->uri = $value;
    }

    /**
     * Return requested format
     *
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * Set requested format
     *
     * @param string $value
     */
    public function setFormat($value) {
        $this->format = $value;
    }
    
    /**
     * Return Route
     * 
     * @return Route
     */
    public function getRoute() {
        return $this->route;
    }
    
    /**
     * Set Route object
     * 
     * @param Route $object
     */
    public function setRoute(Route $object) {
        $this->route = $object;
    }

    /**
     * Return user name
     *
     * @return string
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set user name
     *
     * @param string $value
     */
    public function setUser($value) {
        $this->user = $value;
    }
    
    /**
     * Analyze and collect request data
     */
    public function analyze() {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        }
        
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $this->user = $_SERVER['PHP_AUTH_USER'];
        }
        
        if (isset($_SERVER['REQUEST_URI'])) {
            $uri = null;
            
            if (false !== strpos($_SERVER['REQUEST_URI'], '?')) {
                $uri = stristr($_SERVER['REQUEST_URI'], '?', true);
            } else {
                $uri = $_SERVER['REQUEST_URI'];
            }
            
            $pathinfo = pathinfo(parse_url($uri, PHP_URL_PATH));
            
            $this->uri = str_replace('//', '/', $pathinfo['dirname'] . '/' . $pathinfo['filename']);
            
            if (isset($pathinfo['extension'])) {
                $this->format = $pathinfo['extension'];
            }
        }
        
        if (isset($_SERVER['SERVER_PROTOCOL'])) {
            $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        }
        
        switch ($this->method) {
            case 'GET':
                $this->parameters = $_GET;
                break;
            
            case 'POST':
                $this->parameters = $_POST;
                break;
            
            default:
                $lines = explode('&', file_get_contents('php://input'));
                
                foreach ($lines as $line) {
                    list($name, $value) = explode('=', $line);
                    $this->parameters[$name] = $value;
                }
                break;
        }
    }
}
