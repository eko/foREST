<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

$mapping['get']['/authors'] = array(
    'parameters' => array(
        'required' => array(
            'name' => 'string',
        ),
        'optionals' => array(
            'age' => 'integer'
        )
    ),
    'action' => 'getAuthors',
    'description' => 'List all authors by specified filters'
);
?>