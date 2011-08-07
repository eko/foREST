<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

define('APPLICATION_ENV', 'local');

require_once 'src/Forest/Bootstrap.php';

// Load configuration
$options = array();

$configFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.ini';
$config = parse_ini_file($configFile, true);

if (true === defined('APPLICATION_ENV') && true === isset($config[APPLICATION_ENV])) {
    $options = $config[APPLICATION_ENV];
}

// Bootstrap
$forest = new Forest\Bootstrap($options);

echo $forest->getDuration();
?>
