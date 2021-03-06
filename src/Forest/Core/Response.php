<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core;

use Forest\Core\Abstraction,
    Forest\Core\Exception,
    Forest\Core\Filters\Exporter;

/**
 * Response
 */
class Response extends Abstraction
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

    /**
     * Return total duration time
     *
     * @return float
     */
    public function getDuration() {
        return number_format(((microtime(true) - $this->start) * 100), 5) . 'ms';
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
     * @param string $value
     */
    public function setHeader($value) {
        header($value);
    }
    
    /**
     * Render error message
     * 
     * @param string $message
     * @param int $code
     */
    public function renderError($message, $code) {
        $this->setHeader('HTTP/1.1 ' . $code . ' ' . $message);
        
        $exporter = Exporter::singleton();
        $exporter->setOutput($code . ' ' . $message);
        $exporter->render();
    }
}
