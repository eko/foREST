<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest;

use Forest\Core\Request as Request;
use Forest\Core\Exception as Exception;

use Forest\Logger as Logger;

/**
 * Bootstrap
 */
class Bootstrap
{
    /**
     * Http request object
     * @var object Core\Request
     */
    private $_request = null;
    
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
        $start = microtime(true);
        
        spl_autoload_register(__CLASS__ .'::autoload');
        
        $this->run();
        
        $end = microtime(true);
        
        $this->_duration = ($end - $start);
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
     * Run application
     */
    private function run() {
        $this->_request = new Request();
        $this->_request->analyze();
    }
    
    /**
     * Return total call duration
     * @throws Forest\Exception
     * @return float $_duration
     */
    public function getDuration() {
        if (false === isset($this->_options['debug'])
                || false == $this->_options['debug']) {
            throw new Exception('You need to enable debug mode to get duration time.');
        }
        
        return (number_format($this->_duration, 5) . 'ms');
    }
}
?>