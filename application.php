#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \breath\Command\PracticeCommand());
$application->add(new \breath\Command\DescriptionCommand());
$application->add(new \breath\Command\InstructionCommand());
$application->run();