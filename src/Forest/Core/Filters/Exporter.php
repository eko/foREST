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
 * Exporter
 */
class Exporter
{
    public function filter(Request &$request, Response &$response) {
        print_r($response->getData());
    }
}
