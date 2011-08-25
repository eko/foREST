<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Bundle\Console;

use Forest\Bundle\Console\Command\CreateUserCommand;

/**
 * Application
 */
class Application extends \Symfony\Component\Console\Application
{
    /**
     * Constructor
     * 
     * @param string $name
     * @param string $version
     * 
     * @return \Forest\Bundle\Console\Application
     */
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN') {
        parent::__construct($name, $version);
        
        $this->addCommands(array(
            new CreateUserCommand()
        ));
    }
}
