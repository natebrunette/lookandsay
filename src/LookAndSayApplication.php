<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\LookAndSay;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Tebru\LookAndSay\Command\RunCommand;

/**
 * Class LookAndSayApplication
 *
 * @author Nate Brunette <n@tebru.net>
 */
class LookAndSayApplication extends Application
{
    /**
     * @inheritDoc
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();

        // remove command name from arguments
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
    /**
     * @inheritDoc
     */
    protected function getCommandName(InputInterface $input)
    {
        return RunCommand::NAME;
    }
    /**
     * @inheritDoc
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new RunCommand(RunCommand::NAME);

        return $defaultCommands;
    }
}
