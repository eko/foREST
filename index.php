<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

require_once 'src/Forest/Bootstrap.php';

define('APPLICATION_ENV', 'local');

// Load configuration
$configFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.ini';
$config = parse_ini_file($configFile, true);

$options = array();

if (true === defined('APPLICATION_ENV') && true === isset($config[APPLICATION_ENV])) {
    $options = array_merge($config['all'], $config[APPLICATION_ENV]);
} else {
    throw new \Exception('You need to set an APPLICATION_ENV section in config/settings.ini and specify foREST environment');
}

// Bootstrap
$forest = new Forest\Bootstrap($options);

echo $forest->getDuration();
?>
