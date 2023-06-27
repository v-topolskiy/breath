<?php

declare(strict_types=1);

namespace breath\Practice;

use breath\Exceptions\UndefinedPractice;

class PracticeFactory
{
    public function __construct(private BoxBreathingPractice $box, private AsymmetricBreathingPractice $asymmetric)
    {
    }

    /**
     * @throws UndefinedPractice
     */
    public function createPractice(string $name): Practice
    {
        return match ($name) {
            'box' => $this->box,
            'asymmetric' => $this->asymmetric,
            default => throw new UndefinedPractice()
        };
    }
}