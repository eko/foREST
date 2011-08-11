<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

$mapping['get']['/authors'] = array(
    'resource' => 'Authors',
    'action'   => 'getAuthors',
    'parameters' => array(
        'required' => array(
            'name' => 'string',
        ),
        'optionals' => array(
            'age' => 'integer'
        )
    ),
    'description' => 'List all authors by specified filters'
);
?>