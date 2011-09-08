<?php

/**
 * foREST - a simple RESTful PHP API
 * 
 * @version 1.0
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */

namespace Forest\Bundle\Console\Command;

use Symfony\Component\Console\Command\Command,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

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
        $filename = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 5) . '/config/users.yml');
        
        $users = Yaml::parse($filename);
        
        $htpasswd = realpath(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 5) . '/www/.htpasswd');
        
        $file = fopen($htpasswd, 'w+');
        
        foreach ($users as $user => $data) {
            $password = crypt(trim($data['password']), base64_encode(CRYPT_STD_DES));
            
            fwrite($file, $user . ':' . $password . "\r\n");
        }
        
        fclose($file);
        
        try {
            $output->writeln('<info>Users are now refreshed into .htpasswd file</info>');
        } catch (\Exception $e) {
            $output->writeln('<error>Could not refresh users</error>');
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}