<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

$queries['authors.list'] = array(
    'database' => 'main',
    'query'    => "SELECT *
                   FROM authors
                   WHERE name = ':name:'
                   {AND age = :age:}"
);
?>