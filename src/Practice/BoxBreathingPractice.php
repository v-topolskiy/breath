<?php

declare(strict_types=1);

namespace breath\Practice;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class BoxBreathingPractice extends Practice
{
    /**
     * {@inheritdoc}
     */
    public function getInstruction(): array
    {
        return [
            1 => 'Inhale for a count of four',
            2 => 'Hold your breath for a count of four',
            3 => 'Exhale for a count of four',
            4 => 'Hold your breath for a count of four',
            5 => 'Start the cycle again and breathe this way for 5 minutes',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): array
    {
        return [
            'This technique is used by the U.S. Navy Seals to quickly regain control in a stressful situation.',
            'Imagine a box or square with equal sides. Each side of your square is one breath cycle: inhale, breath hold, exhale, breath hold. Like the sides of a square, the cycles are equal: each lasts for 4 counts or seconds.',
            'When you breathe, imagine moving along the sides of this square. According to clinical psychologist Scott Symington, such visualization helps to focus on the breath and adapt to the necessary rhythm more quickly.'
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function printToConsole(OutputInterface $output): void
    {
        $zoom = 2;
        $cursor = new Cursor($output);
        $cursor->clearScreen();

        $symbol = '*';

        $cursor->moveToPosition(strlen($symbol) + 1, 1);

        $commands = ['right' => 'inhale', 'down' => 'hold', 'left' => 'exhale', 'up' => 'hold'];

        $length = 4 * $zoom;

        $timer = 5 * 60;
        while ($timer > 0) {
            foreach ($commands as $position => $command) {
                for ($i = 0; $i < $length - 1; $i++) {

                    $cursor->savePosition();
                    $cursor->moveToPosition((strlen($symbol) * $length) / 2, strlen($symbol) * $length + 2);
                    $output->write('<info>[' . str_pad($command, 8, ' ', STR_PAD_BOTH) . ']</info>');
                    $cursor->moveToPosition((strlen($symbol) * $length) / 2, strlen($symbol) * $length + 4);
                    $output->write('<info>[' . str_pad(date('i:s', (int)$timer), 8, ' ', STR_PAD_BOTH) . ']</info>');
                    $cursor->restorePosition();

                    $output->write('<fg=gray>' . $symbol . '</>');

                    switch ($position) {
                        case 'right':
                        {
                            $cursor->moveRight();
                            break;
                        }
                        case 'down':
                        {
                            $cursor->moveDown();
                            $cursor->moveLeft(strlen($symbol));
                            break;
                        }
                        case 'left':
                        {
                            $cursor->moveLeft(strlen($symbol) * 2 + 1);
                            break;
                        }
                        case 'up':
                        {
                            $cursor->moveUp();
                            $cursor->moveLeft(strlen($symbol));
                            break;
                        }
                    }
                    usleep(1000000 / $zoom);
                    $timer = $timer - 1 / $zoom;
                }
            }
        }
    }
}