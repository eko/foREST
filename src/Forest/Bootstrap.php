<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest;

use Forest\Core\Kernel,
    Forest\Core\Exception as Exception,
    Forest\Core\Query,
    Forest\Core\Registry,
    Forest\Core\Route,
    Symfony\Component\Yaml\Yaml;

/**
 * Bootstrap
 */
class Bootstrap
{
    /**
     * Constructor
     * 
     * @param string $environment
     */
    public function __construct($environment = null) {
        spl_autoload_register(__CLASS__ . '::autoload');
        
        $this->kernel = new Kernel($environment);
        
        if (null !== $environment) {
            $this->loadConfiguration();
            $this->loadResources();
        
            $this->kernel->run();
        }
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
     * Load resources (routing, queries) from /resources folder
     */
    private function loadResources() {
        $routing = array();
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
                        case 'routing':
                            if (1 === count($content)) {
                                $name = key($content);

                                $route = array($name => new Route($name, $content));
                                $routing = array_merge($routing, $route);
                            } else {
                                foreach ($content as $key => $element) {
                                    $route = array($key => new Route($key, array($key => $element)));
                                    $routing = array_merge($routing, $route);
                                }
                            }
                            break;
                        
                        case 'queries':
                            if (1 === count($content)) {
                                $name = key($content);
                                
                                $query = array($name => new Query($name, $content));
                                $queries = array_merge($queries, $query);
                            } else {
                                foreach ($content as $key => $element) {
                                    $query = array($key => new Query($key, $element));
                                    $queries = array_merge($queries, $query);
                                }
                            }
                            break;
                        
                        default:
                            throw new Exception(sprintf("Loading resources: undefined element: '%s'", $filename));
                            break;
                    }
                } else {
                    include $resourcePath . DIRECTORY_SEPARATOR . $file->getBasename();
                }
            }
        }
        
        Registry::set('routing', $routing);
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
}
