<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Bundle\Console\Command;

use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

/**
 * UserDelCommand
 */
class UserDelCommand extends Command
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('user:del')
            ->setDescription('Delete a user')
            ->addArgument('username', InputArgument::REQUIRED, 'Username to delete')
            ->setHelp(<<<EOT
The <info>user:del</info> command delete specified user.

Give the username to delete like the following:

<info>php console user:del username</info>
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
        
        $filename = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 5) . '/config/users.yml');
        
        $users = Yaml::parse($filename);
        
        if (!isset($users[$username])) {
            throw new \InvalidArgumentException(sprintf("User '%s' does not exists", $username));
        } else {
            unset($users[$username]);
            
            $content = Yaml::dump($users, 1);
            
            $file = fopen($filename, 'w+');
            fwrite($file, "# Users list\n\n" . $content);
            fclose($file);
        }
        
        try {
            $output->writeln(sprintf('<info>Username <comment>%s</comment> successfully deleted!</info>', $username));
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Could not delete username <comment>%s</comment></error>', $username));
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}