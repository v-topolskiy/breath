<?php

declare(strict_types=1);

namespace breath\Command;

use breath\Exceptions\UndefinedPractice;
use breath\Practice\AsymmetricBreathingPractice;
use breath\Practice\BoxBreathingPractice;
use breath\Practice\PracticeFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'breath:instruction',
    description: 'Get breathing practice instruction',
    hidden: false
)]
class InstructionCommand extends \Symfony\Component\Console\Command\Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $factory = new PracticeFactory(new BoxBreathingPractice(), new AsymmetricBreathingPractice());
            $practice = $factory->createPractice($input->getArgument('practice'));
            foreach ($practice->getInstruction() as $id => $line) {
                $output->writeln(sprintf("%s. %s", $id, $line));
            }

            return Command::SUCCESS;
        } catch (UndefinedPractice $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }

    protected function configure()
    {
        $this
            ->setHelp('This command allows you to get breathing practice instruction')
            ->addArgument('practice', InputArgument::OPTIONAL, 'Practice name', 'box');
    }
}