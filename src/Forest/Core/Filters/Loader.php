<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Exception as Exception;
use Forest\Core\Registry as Registry;

use Forest\Core\Request as Request;
use Forest\Core\Response as Response;

/**
 * Loader
 */
class Loader
{
    public function filter(Request &$request, Response &$response) {
        $method = $request->getMethod();
        $uri = $request->getUri();
        
        $route = $this->getRoute($method, $uri);
        $request->setRoute($route);
    }
    
    /**
     * Find route for specified URI
     * 
     * @param type $method
     * @param type $uri
     * 
     * @return array $resource
     */
    private function getRoute($method, $uri) {
        $resource = null;
        
        $mapping = Registry::get('mapping');
        
        $method = strtolower($method);
        
        if (true === is_array($mapping) && true === isset($mapping[$method])) {
            $max = 0;
            
            foreach ($mapping[$method] as $route => $data) {
                $probability = similar_text($uri, $route);
                
                if ($probability > $max) {
                    $max = $probability;
                    $resource = $mapping[$method][$route];
                }
            }
        }
        
        if (null === $resource) {
            throw new Exception(sprintf("Route '%s' not found.", $uri));
        }
        
        return $resource;
    }
}
?>
