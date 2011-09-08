<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Resources;

use Forest\Core\Registry,
    Forest\Core\Request,
    Forest\Core\Resource;

/**
 * Help
 */
class Help extends Resource {
    /**
     * Display help
     * 
     * @param Request $request
     * 
     * @return array
     */
    public function help(Request $request) {
        return Registry::get('routing');
    }
}
