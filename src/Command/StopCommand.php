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
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Stop command.
 *
 * @author St�phane Demonchaux
 */
class StopCommand extends Command
{
	/**
	 * @var ProcessService
	 */
	private $processService;
	
	public function __construct(ProcessService $processService)
	{
		$this->processService = $processService;
		parent::__construct();
	}

    protected function configure()
    {
        $this
            ->setName('stop')
            ->setDescription('Stop a command')
            ->addArgument('aliasOrPid', InputArgument::OPTIONAL, 'alias or pid');
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
    	$aliasOrPid = $input->getArgument('aliasOrPid');

    	if (empty($aliasOrPid)) {
    		$helper = $this->getHelper('question');
    		$question = new ConfirmationQuestion('Kill all ? (y/n, default=n)', false);
    		
    		if (!$helper->ask($input, $output, $question)) {
    			return;
    		}
    		
    		$this->processService->stopAll();
    		
    		$output->writeln('<comment>stop all successfully</comment>');
    		return;
    	}
    	
		$this->processService->stop($input->getArgument('aliasOrPid'));
		
		$output->writeln(sprintf('<comment>%s stop successfully</comment>', $input->getArgument('aliasOrPid')));
    }
}
