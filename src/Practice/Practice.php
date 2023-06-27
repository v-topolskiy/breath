<?php

declare(strict_types=1);

namespace breath\Practice;

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
     * @return void
     */
    abstract public function execute(): void;
}