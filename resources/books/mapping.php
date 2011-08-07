<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

$mapping['get']['/books'] = array(
    'parameters' => array(
        'required' => array(
            'title' => 'string',
        ),
        'optionals' => array(
            'year' => 'integer'
        )
    ),
    'action' => 'getBooks',
    'description' => 'List all books by specified filters'
);
?>