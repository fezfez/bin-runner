<?php

/**
 * This file is part of the PHP to Zephir package.
 *
 * (c) St�phane Demonchaux <demonchaux.stephane@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BinRunner;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Output\OutputInterface;
use BinRunner\Command\StartCommandFactory;
use BinRunner\Command\StopCommandFactory;
use BinRunner\Command\ListCommandFactory;

/**
 * Create CLI instance.
 *
 * @author St�phane Demonchaux
 */
class CliFactory
{
    /**
     * Create CLI instance.
     *
     * @return Application
     */
    public static function getInstance(OutputInterface $output)
    {
        $questionHelper = new QuestionHelper();
        $application = new Application('Bin runner Command Line Interface', 'Beta 0.2.1');
        $application->getHelperSet()->set(new FormatterHelper(), 'formatter');
        $application->getHelperSet()->set($questionHelper, 'question');

        $application->add(StartCommandFactory::getInstance($output));
        $application->add(StopCommandFactory::getInstance($output));
        $application->add(ListCommandFactory::getInstance($output));

        return $application;
    }
}
