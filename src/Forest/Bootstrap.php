<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest;

use Forest\Core\Exception as Exception;
use Forest\Core\Dispatcher as Dispatcher;
use Forest\Core\Request as Request;

use Forest\Logger as Logger;

/**
 * Bootstrap
 */
class Bootstrap
{
    /**
     * Options availables
     * @var array
     */
    private $_options = array();
    
    /**
     * Resources loaded
     * @var array
     */
    private $_resources = array();
    
    /**
     * Total call duration (debug mode)
     * @var float
     */
    private $_duration = null;
    
    /**
     * Constructor
     * 
     * @param array $options
     */
    public function __construct($options = array()) {
        $this->_options = $options;

        $start = microtime(true);
        
        spl_autoload_register(__CLASS__ .'::autoload');
        
        $this->loadResources();
        $this->run();
        
        $end = microtime(true);
        
        $this->_duration = ($end - $start);
    }
    
    /**
     * Autoload all classes in project
     * 
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
     * Load resources (mapping, queries) from /resources folder
     */
    private function loadResources() {
        $directory = realpath(dirname(__FILE__)
                    . str_repeat(DIRECTORY_SEPARATOR . '..', 2)
                    . DIRECTORY_SEPARATOR . 'resources'
        );
        
        $resources = $this->readDirectory($directory);
        
        foreach ($resources as $resource) {
            $resourcePath = $directory . DIRECTORY_SEPARATOR . $resource;
            $resourceFiles = $this->readDirectory($resourcePath);
            
            foreach ($resourceFiles as $file) {
                $file = $resourcePath . DIRECTORY_SEPARATOR . $file;
                include_once $file;
            }
        }
        
        $this->_resources = array(
            'mapping' => $mapping,
            'queries' => $queries
        );
    }
    
    /**
     * Return directory items
     * 
     * @param string $directory
     * 
     * @return array $items
     */
    private function readDirectory($directory) {
        $items = array();
        
        $handle = opendir($directory);
        
        while (false !== ($item = readdir($handle))) {
            if (false === in_array($item, array('.', '..'))) {
                $items[] = $item;
            }
        }
        
        closedir($handle);
        
        return $items;
    }
    
    /**
     * Run application
     */
    private function run() {
        $request = new Request();
        $request->analyze();
        
        $dispatcher = new Dispatcher($request);
        $dispatcher->dispatch();
    }
    
    /**
     * Return total call duration
     * 
     * @throws Forest\Core\Exception
     * 
     * @return float $_duration
     */
    public function getDuration() {
        return (number_format($this->_duration, 5) . 'ms');
    }
}
?>