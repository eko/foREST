<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '../src/Forest/Bootstrap.php';

define('APPLICATION_ENV', 'local');

$forest = new Forest\Bootstrap(APPLICATION_ENV);

echo $forest->getDuration();
?>
