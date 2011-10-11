<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Abstraction,
    Forest\Core\Exception,
    Forest\Core\Request,
    Forest\Core\Response;

/**
 * Exporter
 */
class Exporter extends Abstraction
{
    /**
     * Output formatted data
     * @var string
     */
    private $output = null;
    
    /**
     * Construct
     */
    public function __construct() {
        parent::setSingleton($this);
    }
    
    /**
     * Exporter filter method (output data)
     *
     * @param Request &$request
     * @param Response &$response
     */
    public function filter(Request &$request, Response &$response) {
        $format = $request->getFormat();
        $data = $response->getData();
        
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
        $file = $path . $format . '.php';
        
        $output = $this->formatData($data, $file);

        $response->setHeader('Execution-Time: ' . $response->getDuration());

        $this->setOutput($output);
        $this->render();
    }
    
    /**
     * Format data for output with specified format file
     *
     * @param array $data
     * @param string $file
     *
     * @return string $output
     */
    public function formatData($data, $file = null) {
        $output = null;
        
        ob_start();
        
        if (!is_null($file) && file_exists($file)) {
            include_once $file;
        } else {
            print_r($data);
        }
        
        $output = ob_get_clean();
        
        return $output;
    }
    
    /**
     * Render output and exit
     */
    public function render() {
        if (null === $this->output) {
            throw new Exception(500, 'Cannot output null output data.');
        }
        
        exit($this->output);
    }
    
    /**
     * Set output data
     *
     * @param string $value
     */
    public function setOutput($value) {
        $this->output = $value;
    }
}
