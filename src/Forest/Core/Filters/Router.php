<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Exception,
    Forest\Core\Registry,
    Forest\Core\Request,
    Forest\Core\Response;

/**
 * Router
 */
class Router
{
    /**
     * Router filter method (find the correct route)
     * 
     * @param Request &$request
     * @param Response &$response 
     */
    public function filter(Request &$request, Response &$response) {
        $method = $request->getMethod();
        $uri = $request->getUri();
        
        $route = $this->findRoute($method, $uri);
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
    private function findRoute($method, $uri) {
        $route = null;
        
        $routing = Registry::get('routing');
        
        $method = strtolower($method);
        
        if (true === is_array($routing)) {
            foreach ($routing as $name => $currentRoute) {
                $name = explode(':/', $name);
                $name = '/' . $name[1];
                
                $routeElements = explode('/', $name);
                $uriElements = explode('/', $uri);
                
                if (count($uriElements) === count($routeElements)) {
                    foreach ($routeElements as $key => $element) {
                        if (':' === substr($element, 0, 1)) {
                            $name = preg_replace("/{$element}/", $uriElements[$key], $name);
                        }
                    }
                }
                
                if ($uri === $name) {
                    $route = $currentRoute;
                }
            }
        }
        
        if (null === $route) {
            throw new Exception(sprintf("Route '%s' not found.", $uri));
        }
        
        return $route;
    }
}
