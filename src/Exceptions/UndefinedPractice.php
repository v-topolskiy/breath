<?php

declare(strict_types=1);

namespace breath\Exceptions;

class UndefinedPractice extends \Exception
{
    protected $message = 'Practice not found';
}