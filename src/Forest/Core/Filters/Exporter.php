<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Core\Filters;

use Forest\Core\Request as Request;
use Forest\Core\Response as Response;

/**
 * Exporter
 */
class Exporter
{
    public static function filter(Request &$request, Response &$response) {
        print_r($response->getData());
    }
}
