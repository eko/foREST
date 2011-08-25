<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Bundle\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Database tool allows you to easily drop and create your configured databases.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class CreateUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('create:user')
            ->setDescription('Create a new user')
            ->addOption('username', null, InputOption::VALUE_REQUIRED, 'Username to create')
            ->addOption('password', null, InputOption::VALUE_REQUIRED, 'Password for username')
            ->setHelp(<<<EOT
The <info>create:user</info> command creates a new user.

Give a username and a password like the following:

<info>php console create:user --username=myuser --password=mypassword</info>
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //@todo: Add code...
        
        try {
            $output->writeln(sprintf('<info>Username <comment>%s</comment> successfully created!</info>', $username));
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Could not create username <comment>%s</comment></error>', $username));
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}