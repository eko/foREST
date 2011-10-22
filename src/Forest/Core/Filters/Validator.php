<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Request,
    Forest\Core\Response;

/**
 * Validator
 */
class Validator
{
    /**
     * Validator filter method (validate input parameters)
     *
     * @param Request $request
     * @param Response $response
     */
    public function filter(Request &$request, Response &$response) {
        $route = $request->getRoute();
        
        $routeParameters = $route->getParameters();
        $requestParameters = $request->getParameters();
        
        if (isset($routeParameters['required'])) {
            foreach ($routeParameters['required'] as $name => $value) {
                if (isset($requestParameters[$name])) {
                    $value = $requestParameters[$name];
                    
                    $correct = $this->validate($type, $value);
                } else {
                    $response->renderError(sprintf("Parameter '%s' is required.", $name), 406);
                }
            }
        }
    }
    
    /**
     * Return if value has a correct type
     * 
     * @param string $type
     * @param mixed $value
     * 
     * @return boolean $correct
     */
    private function validate($type, $value) {
        $correct = false;
        
        switch ($type) {
            case 'string':
                if (!empty($value)) {
                    $correct = true;
                }
                break;
                
            case 'integer':
                if (!empty($value) && is_numeric($value)) {
                    $correct = true;
                }
                break;
            
            default:
                $correct = false;
                break;
        }
        
        return $correct;
    }
}
