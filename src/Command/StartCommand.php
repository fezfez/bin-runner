<?php

/**
 * This file is part of the PHP to Zephir package.
 *
 * (c) St�phane Demonchaux <demonchaux.stephane@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BinRunner\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use BinRunner\ProcessService;
use BinRunner\ProcessDAO;
use BinRunner\ProcessNotFoundException;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Start command.
 *
 * @author St�phane Demonchaux
 */
class StartCommand extends Command
{
	/**
	 * @var ProcessService
	 */
	private $processService;
	/**
	 * @var ProcessDAO
	 */
	private $processDAO;

    public function __construct(ProcessService $processService, ProcessDAO $processDAO)
    {
        $this->processService = $processService;
        $this->processDAO = $processDAO;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('start')
            ->setDescription('Start a command')
            ->addArgument('commandtorun', InputArgument::REQUIRED, 'command to run')
            ->addArgument('alias', InputArgument::OPTIONAL, 'alias');
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
    	try {
    		$this->processDAO->findByCommand($input->getArgument('commandtorun'));
    		
    		$helper = $this->getHelper('question');
    		$question = new ConfirmationQuestion(
    			'The exact same command are already running, do you want to continue ? (y/n, default=n)',
    			false
    		);
    		
    		if (!$helper->ask($input, $output, $question)) {
    			return;
    		}
    	} catch (ProcessNotFoundException $e) {
    		// Normal case
    	}

    	$output->writeln(sprintf(
    		'Process created with alias "%s"',
			$this->processService->start($input->getArgument('commandtorun'), $input->getArgument('alias'))
    	));
    }
}