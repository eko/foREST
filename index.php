<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

require_once 'src/foREST/Core/Bootstrap.php';

use foRest\Core as Core;

$forest = new Core\Bootstrap(true);

echo $forest->getDuration(); exit;
?>
