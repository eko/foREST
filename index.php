<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

require_once 'src/Forest/Bootstrap.php';

$forest = new Forest\Bootstrap(
    array('debug' => true)
);

echo $forest->getDuration();
?>
