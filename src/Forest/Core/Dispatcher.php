<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Exception as Exception;
use Forest\Core\Response as Response;
use Forest\Core\Request as Request;

/**
 * Dispatcher
 */
class Dispatcher
{
    /**
     * Filters list
     * @var array
     */
    private $_filters = array(
        'Forest\Core\Filters\Loader',
        'Forest\Core\Filters\Access',
        'Forest\Core\Filters\Validator',
        'Forest\Core\Filters\Resource',
        'Forest\Core\Filters\Exporter'
    );
    
    /**
     * Request object
     * @var Request
     */
    private $_request = null;
    
    /**
     * Response object
     * @var Response
     */
    private $_response = null;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->_request = new Request();
        $this->_response = new Response();
    }
    
    /**
     * Execute filters
     */
    public function dispatch() {
        foreach ($this->_filters as $class) {
            if (true === class_exists($class) && true === method_exists($class, 'filter')) {
                $filter = new $class;
                $filter->filter($this->_request, $this->_response);
            } else {
                throw new Exception(sprintf("Filter class '%s' or method 'filter' does not exists.", $class));
            }
        }
    }
}
