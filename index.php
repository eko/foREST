<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

require_once 'src/Forest/Bootstrap.php';

define('APPLICATION_ENV', 'local');

// Bootstrap application and components
$forest = new Forest\Bootstrap(
    array(
        'Yaml' => 'Symfony\Component\Yaml\Yaml'
    )
);

echo $forest->getDuration();
?>
