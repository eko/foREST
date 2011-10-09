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
        $format = $request->getFormat();
        $data = $response->getData();
        
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
        $formatPath = $path . $format . '.php';
        
        $output = null;
        
        ob_start();
        
        if (file_exists($formatPath)) {
            include_once $formatPath;
        } else {
            print_r($data);
        }
        
        $output = ob_get_clean();
        
        echo $output; exit;
    }
}
