<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Exception as Exception,
    Forest\Core\Response,
    Forest\Core\Request;

/**
 * Kernel
 */
class Kernel
{
    /**
     * Application name
     */
    const NAME = 'foREST - Restful API';

    /**
     * Application version
     */
    const VERSION = 1.0;
    
    /**
     * Filters list
     * @var array
     */
    private $filters = array(
        'Forest\Core\Filters\Router',
        'Forest\Core\Filters\Access',
        'Forest\Core\Filters\Validator',
        'Forest\Core\Filters\Resource',
        'Forest\Core\Filters\Exporter'
    );
    
    /**
     * Application environment
     * 
     * @var string
     */
    private $environment = null;
    
    /**
     * Request object
     * @var Request
     */
    private $request = null;
    
    /**
     * Response object
     * @var Response
     */
    private $response = null;
    
    /**
     * Constructor
     * 
     * @param string $environment
     */
    public function __construct($environment = null) {
        $this->request = new Request();
        $this->response = new Response();
        
        $this->environment = $environment;
    }
    
    /**
     * Run filters
     */
    public function run() {
        foreach ($this->filters as $class) {
            if (true === class_exists($class) && true === method_exists($class, 'filter')) {
                $filter = new $class;
                $filter->filter($this->request, $this->response);
            } else {
                throw new Exception(sprintf("Filter class '%s' or method 'filter' does not exists.", $class));
            }
        }
    }
    
    /**
     * Return application environment
     * 
     * @return string
     */
    public function getEnvironment() {
        return $this->environment;
    }
    
    /**
     * Return application name
     * 
     * @return string
     */
    public function getName() {
        return self::NAME;
    }
    
    /**
     * Return version number
     * 
     * @return float
     */
    public function getVersion() {
        return self::VERSION;
    }
}
