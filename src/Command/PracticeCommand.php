<?php

declare(strict_types=1);

namespace breath\Command;

use breath\Exceptions\UndefinedPractice;
use breath\Practice\BoxPractice;
use breath\Practice\PracticeFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'breath:practice',
    description: 'Start breathing practice',
    hidden: false
)]
class PracticeCommand extends \Symfony\Component\Console\Command\Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $factory = new PracticeFactory(new BoxPractice());
            $practice = $factory->createPractice($input->getArgument('practice'));
            $practice->printToConsole($output);

            return Command::SUCCESS;
        } catch (UndefinedPractice $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }

    protected function configure()
    {
        $this
            ->setHelp('This command allows you to start breathing practice')
            ->addArgument('practice', InputArgument::OPTIONAL, 'Practice name', 'box');
    }

}