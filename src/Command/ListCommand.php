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
use BinRunner\ProcessDAO;
use Symfony\Component\Console\Helper\Table;
use BinRunner\Driver\DriverInterface;

/**
 * Start command.
 *
 * @author St�phane Demonchaux
 */
class ListCommand extends Command
{
    /**
     * @var ProcessDAO
     */
    private $processDAO;
    /**
     * @var DriverInterface
     */
    private $driver;

    public function __construct(ProcessDAO $processDAO, DriverInterface $driver)
    {
        $this->processDAO = $processDAO;
        $this->driver = $driver;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('show')
            ->setDescription('List all command');
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
    	$processCollection = $this->processDAO->findAll();
    	
    	if (empty($processCollection)) {
    		$output->writeln("No process to show");
    		return;
    	}

    	$table = new Table($output);
    	$table->setHeaders(['alias', 'command', 'pid', 'is running']);
    	
		foreach ($processCollection as $process) {
			$table->addRow([$process->getAlias(), $process->getCommand(), $process->getPid(), $this->driver->isRunning($process->getPid())]);
		}
		
		$table->render();
    }
}