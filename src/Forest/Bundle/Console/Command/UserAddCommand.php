<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Bundle\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Yaml\Yaml;

/**
 * UserAddCommand
 */
class UserAddCommand extends Command
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('user:add')
            ->setDescription('Add a new user')
            ->addArgument('username', InputArgument::REQUIRED, 'Username to create')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addArgument('role', InputArgument::OPTIONAL, 'User role')
            ->setHelp(<<<EOT
The <info>user:add</info> command creates a new user.

Give a username and a password like the following:

<info>php console user:add username password <role></info>
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
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        
        if (null !== $input->getArgument('role')) {
            $role = $input->getArgument('role');
        }
        
        $filename = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 5) . '/config/users.yml');
        
        $users = Yaml::parse($filename);
        
        if (isset($users[$username])) {
            throw new \InvalidArgumentException(sprintf("User '%s' already exists", $username));
        } else {
            $users[$username] = array(
                'password' => $password,
                'role'     => (isset($role) ? $role : 'none')
            );
            
            $content = Yaml::dump($users, 1);
            
            $file = fopen($filename, 'w+');
            fwrite($file, "# Users list\n\n" . $content);
            fclose($file);
        }
        
        try {
            $output->writeln(sprintf('<info>Username <comment>%s</comment> successfully created!</info>', $username));
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Could not create username <comment>%s</comment></error>', $username));
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}