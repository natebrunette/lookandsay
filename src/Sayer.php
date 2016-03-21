<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\LookAndSay;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Sayer
 *
 * @author Nate Brunette <n@tebru.net>
 */
class Sayer
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var ProgressBar
     */
    private $progress;

    /**
     * Constructor
     *
     * @param OutputInterface $output
     * @param ProgressBar $progress
     */
    public function __construct(OutputInterface $output, ProgressBar $progress)
    {
        $this->output = $output;
        $this->progress = $progress;
    }

    /**
     * Iterate a number times on the provided string
     *
     * @param string $string
     * @param int $iterations
     * @param bool $debug
     * @return string
     */
    public function say(string $string, int $iterations, bool $debug): string
    {
        for ($i = 0; $i < $iterations; $i++) {
            // find all occurrences of 1 or more of the same character and replace with
            // the length + the character
            $string = preg_replace_callback(
                '/(.)\1*/',
                function(array $matches) {
                    // $matches [0] is the full match, $matches[1] is the character
                    return strlen($matches[0]) . $matches[1];
                },
                $string
            );

            if ($debug) {
                $this->progress->advance();
            }
        }

        if ($debug) {
            $this->progress->finish();
            $this->output->write('', true);
        }

        return $string;
    }
}
