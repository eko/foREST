<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace foRest\Core;

/**
 * Bootstrap
 */
class Bootstrap
{
    /**
     * Debug mode enabled/disabled
     * @var bool
     */
    private $_debug = false;
    
    /**
     * Http object
     * @var object Core\Http
     */
    private $_http = null;
    
    /**
     * Total call duration (debug mode)
     * @var float
     */
    private $_duration = null;
    
    /**
     * Constructor
     * @param bool $debug
     */
    public function __construct($debug = false) {
        if (true === $debug) {
            $this->_debug = true;
            $start = microtime(true);
        }
        
        spl_autoload_register(__CLASS__ .'::autoload');
        
        $this->boot();
        
        if (true === $debug) {
            $end = microtime(true);
            $this->_duration = ($end - $start);
        }
    }
    
    /**
     * Autoload all class in project
     * @param string $class
     */
    public static function autoload($class) {
        include 'src/' . str_replace(array('_', '\\'), '/', $class) . '.php';
    }
    
    /**
     * Boot application
     */
    private function boot() {
        $this->_http = new Http();
        $this->_http->collect();
    }
    
    /**
     * Return total call duration
     * @throws \foRESTException
     * @return float $_duration
     */
    public function getDuration() {
        if (false === $this->_debug) {
            throw new \foRESTException('You need to enable debug mode.');
        }
        
        return (number_format($this->_duration, 5) . 'ms');
    }
}
?>