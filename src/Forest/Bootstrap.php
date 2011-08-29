<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest;

use Forest\Core\Kernel;
use Forest\Core\Exception as Exception;
use Forest\Core\Registry;

use Symfony\Component\Yaml\Yaml;

/**
 * Bootstrap
 */
class Bootstrap
{
    
    /**
     * Total call duration (debug mode)
     * @var float
     */
    private $duration = null;
    
    /**
     * Constructor
     * 
     * @param string $environment
     */
    public function __construct($environment = null) {
        $start = microtime(true);
        
        spl_autoload_register(__CLASS__ .'::autoload');
        
        $this->loadConfiguration();
        $this->loadResources();
        
        $this->kernel = new Kernel($environment);
        $this->kernel->run();
        
        $end = microtime(true);
        
        $this->duration = ($end - $start);
    }
    
    /**
     * Autoload all classes in project
     * 
     * @param string $class
     */
    public function autoload($class) {
        $basedir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
        
        $classfile = $basedir . DIRECTORY_SEPARATOR . str_replace(array('_', '\\'), '/', $class) . '.php';
        
        if (true === file_exists($classfile)) {
            include $classfile;
        }
    }
    
    /**
     * Load configuration
     */
    private function loadConfiguration() {
        $basedir = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 2));
        $config = $basedir . DIRECTORY_SEPARATOR . 'config/configuration.yml';
        
        if (false === file_exists($config)) {
            throw new Exception(sprintf('Configuration file does not exists at location: %s', $config));
        }
        
        $content = file_get_contents($config);
        $config = Yaml::parse($content);
        
        Registry::set('config', $config);
    }
    
    /**
     * Load resources (mapping, queries) from /resources folder
     */
    private function loadResources() {
        $mapping = array();
        $queries = array();
        
        $directory = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 2) . DIRECTORY_SEPARATOR . 'resources');
        $resources = $this->readDirectory($directory);
        
        foreach ($resources as $resource) {
            $resourcePath = $directory . DIRECTORY_SEPARATOR . $resource;
            $resourceFiles = $this->readDirectory($resourcePath);
            
            foreach ($resourceFiles as $file) {
                $file = new \SplFileInfo($resourcePath . DIRECTORY_SEPARATOR . $file);
                
                if ('yml' === $file->getExtension()) {
                    $filecontent = file_get_contents($file);
                    $content = Yaml::parse($filecontent);
                    
                    $filename = $file->getBasename('.yml');
                    
                    switch ($filename) {
                        case 'mapping':
                            $mapping = array_merge($mapping, $content);
                            break;
                        
                        case 'queries':
                            $queries = array_merge($queries, $content);
                            break;
                        
                        default:
                            throw new Exception(sprintf("Loading resources: undefined element: '%s'", $key));
                            break;
                    }
                } else {
                    include $resourcePath . DIRECTORY_SEPARATOR . $file->getBasename();
                }
            }
        }
        
        Registry::set('mapping', $mapping);
        Registry::set('queries', $queries);
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
     * Return Kernel class
     * 
     * @return \Forest\Core\Kernel
     */
    public function getKernel() {
        return $this->kernel;
    }
    
    /**
     * Return total call duration
     * 
     * @throws \Forest\Core\Exception
     * 
     * @return float $_duration
     */
    public function getDuration() {
        return (number_format($this->duration, 5) . 'ms');
    }
}
