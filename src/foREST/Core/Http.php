<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace foRest\Core;

/**
 * HTTP
 */
class Http
{
    /**
     * HTTP Method
     * @var string
     */
    public static $_method = null;
    
    /**
     * HTTP Protocol
     * @var string
     */
    public static $_protocol = null;
    
    /**
     * HTTP URI
     * @var string
     */
    public static $_uri = null;
    
    /**
     * Return HTTP Method
     * @return string $_method
     */
    public function getMethod() {
        return self::$_method;
    }
    
    /**
     * Return HTTP Protocol
     * @return string $_protocol
     */
    public function getProtocol() {
        return self::$_protocol;
    }
    
    /**
     * Return HTTP Uri
     * @return string $_uri
     */
    public function getUri() {
        return self::$_uri;
    }
    
    /**
     * Collect server data
     */
    public function collect() {
        if (true === isset($_SERVER['REQUEST_METHOD'])) {
            self::$_method = $_SERVER['REQUEST_METHOD'];
        }
        
        if (true === isset($_SERVER['REQUEST_URI'])) {
            self::$_uri = $_SERVER['REQUEST_URI'];
        }
        
        if (true === isset($_SERVER['SERVER_PROTOCOL'])) {
            self::$_protocol = $_SERVER['SERVER_PROTOCOL'];
        }
    }
}
?>
