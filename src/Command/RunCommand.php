<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\LookAndSay\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tebru\LookAndSay\Sayer;

/**
 * Class RunCommand
 *
 * @author Nate Brunette <n@tebru.net>
 */
class RunCommand extends Command
{
    const NAME = 'run';

    /**#@+
     * Command Options
     */
    const NO_DEBUG = 'no-debug';
    const NO_STRING = 'no-string';
    const STARTING = 'starting';
    const ITERATIONS = 'iterations';
    /**#@-*/

    /**#@+
     * Default Options
     */
    const DEFAULT_STARTING = '132';
    const DEFAULT_ITERATIONS = 50;
    /**#@-*/

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName(self::NAME);
        $this->addOption(self::NO_DEBUG, null, InputOption::VALUE_NONE, 'Disable debugging output');
        $this->addOption(self::NO_STRING, null, InputOption::VALUE_NONE, 'Do not output the final string');
        $this->addOption(self::STARTING, null, InputOption::VALUE_REQUIRED, 'The starting number to use');
        $this->addOption(self::ITERATIONS, null, InputOption::VALUE_REQUIRED, 'Number of iterations to run');
    }
    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $debug = !$input->getOption(self::NO_DEBUG);
        $displayString = !$input->getOption(self::NO_STRING);
        $starting = (string) $input->getOption(self::STARTING) ?: self::DEFAULT_STARTING;
        $iterations = (int) $input->getOption(self::ITERATIONS) ?: self::DEFAULT_ITERATIONS;

        // move up one line
        $output->write("\033[A");

        // set text to green
        $output->write("\033[32m");

        $progress = new ProgressBar($output, $iterations);
        $sayer = new Sayer($output, $progress);

        $start = microtime(true);
        $string = $sayer->say($starting, $iterations, $debug);
        $end = microtime(true);

        // set text to white
        $output->write("\033[0m");

        if ($displayString) {
            $output->write($string, true);
        }

        if ($debug) {
            $output->write('Length: ' . strlen($string), true);
            $output->write('Time: ' . ($end - $start), true);
            $output->write('Memory: ' . (memory_get_usage(true) / 1000000) . 'MB', true);
        }
    }
}
