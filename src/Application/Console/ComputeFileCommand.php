<?php
declare(strict_types = 1);

namespace App\Application\Console;

use App\Application\File\FileProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Compute route from file
 */
class ComputeFileCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:compute:file';

    /**
     * @throws \Throwable
     */
    protected function configure()
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'file path');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     *
     * @throws \App\Application\Exception\ApplicationException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $provider = new FileProvider($input->getArgument('file'));

        foreach($provider->iterate() as $testCase)
        {
            $destination = $testCase->averageDestination();

            $output->writeln(\sprintf('%.6g %.6g %.6g', $destination->x(), $destination->y(), $testCase->deviationLongestPath()->value()));
        }

        return 0;
    }

}