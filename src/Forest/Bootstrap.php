<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest;

use Forest\Core\Http as Http;
use Forest\Core\Exception as Exception;

use Forest\Logger as Logger;

/**
 * Bootstrap
 */
class Bootstrap
{
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
     * Options availables
     * @var array
     */
    private $_options = array();
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct($options = array()) {
        if (true === isset($options['debug']) && true === $options['debug']) {
            $start = microtime(true);
        }
        
        spl_autoload_register(__CLASS__ .'::autoload');
        
        $this->boot();
        
        if (true === isset($options['debug']) && true === $options['debug']) {
            $end = microtime(true);
            $this->_duration = ($end - $start);
        }
        
        $this->_options = $options;
    }
    
    /**
     * Autoload all classes in project
     * @param string $class
     */
    public function autoload($class) {
        $basedir = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');
        
        $classfile = $basedir . DIRECTORY_SEPARATOR . str_replace(array('_', '\\'), '/', $class) . '.php';
        
        if (true === file_exists($classfile)) {
            include $classfile;
        }
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
     * @throws Forest\Exception
     * @return float $_duration
     */
    public function getDuration() {
        if (false === isset($this->_options['debug'])
                || false === $this->_options['debug']) {
            throw new Exception('You need to enable debug mode to get duration time.');
        }
        
        return (number_format($this->_duration, 5) . 'ms');
    }
}
?>