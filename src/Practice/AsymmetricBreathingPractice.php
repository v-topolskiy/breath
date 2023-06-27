<?php

declare(strict_types=1);

namespace breath\Practice;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class AsymmetricBreathingPractice extends Practice
{

    /**
     * @inheritDoc
     */
    public function getInstruction(): array
    {
        return [
            1 => 'Inhale through your nose for two counts.',
            2 => 'Exhale for 8-10 counts - ideally, the exhale should be five times longer than the inhale.',
            3 => 'Continue to breathe like this for several minutes',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): array
    {
        return [
            'This technique is based on lengthening the exhalation, the important point: there\'s no need to hold your breath.',
            'The main thing is to inhale through the nose, exhale through the mouth, and make the exhale five times longer than the inhale.'
        ];
    }

    /**
     * @inheritDoc
     */
    public function printToConsole(OutputInterface $output): void
    {
        $time = 5 * 60;

        $progressBar = new ProgressBar($output, 100);
        $progressBar->setBarCharacter('<fg=#b7cfe4;bg=#b7cfe4>█</>');
        $progressBar->setEmptyBarCharacter('<fg=#3e5069;bg=#3e5069>█</>');

        $progressBar->setFormatDefinition('custom', '<fg=#3e5069>[%message%] [%bar%]</>');
        $progressBar->setFormat('custom');

        $progressBar->start();

        while ($time > 0) {
            for ($i = 0; $i < 100; $i++) {
                $progressBar->setMessage('Inhale through your nose');
                $progressBar->setProgressCharacter('<fg=#b7cfe4;bg=#3e5069>▶</>');
                $progressBar->advance();
                usleep(1_000_000 / 50);
                $time--;
            }
            for ($i = 0; $i < 100; $i++) {
                $progressBar->setMessage('Exhale through the mouth');
                $progressBar->setProgressCharacter('<fg=#3e5069;bg=#b7cfe4>◀</>');
                $progressBar->advance(-1);
                usleep((int)(1_000_000 / 12.5));
                $time--;
            }

        }

        $progressBar->finish();
    }
}