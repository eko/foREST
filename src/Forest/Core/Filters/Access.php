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
 * Access
 */
class Access
{
    /**
     * Access filter method (verify access control)
     *
     * @param Request &$request
     * @param Response &$response
     */
    public function filter(Request &$request, Response &$response) {
        
    }
}
