<?php

namespace ContaoDoctrineCache\Command;

use ContaoDoctrineCache\Events\Event\FlushCacheEvent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearDoctrineCache extends \Symfony\Component\Console\Command\Command
{

    protected $database;

    /**
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('contao-doctrine-cache:flush-all')
            ->setDescription('Flush the whole doctrine cache');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input  The command input.
     * @param OutputInterface $output The command output.
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getCache()->flushAll();
        $output->writeln('successfully flushed the cache');
    }

    /**
     * Get the docrine-cache from the service container.
     *
     * @return mixed
     */
    protected function getCache()
    {
        return $GLOBALS['container']['doctrine-cache'];
    }
}
