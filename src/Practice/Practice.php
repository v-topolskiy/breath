<?php

declare(strict_types=1);

namespace breath\Practice;

use Symfony\Component\Console\Output\OutputInterface;

abstract class Practice
{
    /**
     * @return string[]
     */
    abstract public function getInstruction(): array;

    /**
     * @return string[]
     */
    abstract public function getDescription(): array;

    /**
     * @param OutputInterface $output
     * @return void
     */
    abstract public function printToConsole(OutputInterface $output): void;
}