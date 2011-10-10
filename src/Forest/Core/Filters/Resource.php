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
 * Resource
 */
class Resource
{
    /**
     * Resource filter method
     *
     * @param Request &$request
     * @param Response &$response
     */
    public function filter(Request &$request, Response &$response) {
        $route = $request->getRoute();
        
        $resource = $route->getResource();
        $action = $route->getAction();
        
        $class = new $resource;
        $result = $class->{$action}($request);

        $response->setData($result);
    }
}
