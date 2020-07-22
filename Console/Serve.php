<?php

namespace Wesleydeveloper\Developer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class Serve extends Command
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('serve');
        $this->setDescription('Start a Magento Server');
        $this->addArgument(
            'host',
            InputArgument::OPTIONAL,
            'Set host',
            '127.0.0.1'
        );
        $this->addArgument(
            'port',
            InputArgument::OPTIONAL,
            'Set port',
            '8082'
        );
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $serve['host'] = $input->getArgument('host');
        $serve['port'] = $input->getArgument('port');
        $serve = implode(':', $serve);
        $command = "php -S {$serve} -t ./pub/ phpserver/router.php \\";
        $messages = ["Magento Server started in http://{$serve}"];
        exec($command);
    }
}
