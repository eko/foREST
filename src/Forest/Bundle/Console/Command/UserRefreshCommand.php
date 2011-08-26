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
 * UserRefreshCommand
 */
class UserRefreshCommand extends Command
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('user:refresh')
            ->setDescription('Refresh users .htpasswd')
            ->setHelp(<<<EOT
The <info>user:refresh</info> command refresh .htpasswd.
EOT
        );
    }

    /**
     * Execute command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //@todo: Add code...
        
        try {
            $output->writeln(sprintf('<info>Users are now successfully refreshed</info>', $username));
        } catch (\Exception $e) {
            $output->writeln('<error>Could not refresh users</error>');
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}