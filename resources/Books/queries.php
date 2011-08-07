<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

$queries['books.list'] = array(
    'database' => 'main',
    'query'    => "SELECT *
                   FROM books
                   WHERE title = ':title:'
                   {AND year = :year:}"
);
?>