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

class ProcessService
{
	/**
	 * @var ProcessDAO
	 */
	private $processDAO;
	/**
	 * @var ProcessManager
	 */
	private $processManager;
	
	public function __construct(ProcessDAO $processDAO, ProcessManager $processManager)
	{
		$this->processDAO = $processDAO;
		$this->processManager = $processManager;
	}
	
	public function start($command, $alias = null)
	{
		$alias = $this->createAlias($command, $alias);
		
		$pid = $this->processManager->start($command);
		$this->processDAO->insert($pid, $command, $alias);
		
		return $alias;
	}
	
	private function createAlias($command, $alias = null)
	{
		$num = '';
		do {
			$alias = substr($command, 0, strpos($command, ' ')).$num;
			try {
				$this->processDAO->find($alias);
				$continue = true;
			} catch (ProcessNotFoundException $e) {
				$continue = false;
			}
			if (empty($num)) {
				$num = 0;
			}
			$num++;
		} while($continue);
		
		return $alias;
	}
	
	public function stop($pidOrAlias)
	{
		$process = $this->processDAO->find($pidOrAlias);
	
		$this->processManager->stop($process->getPid());
		$this->processDAO->remove($process->getPid());
	}
	
	public function stopAll()
	{
		foreach ($this->processDAO->findAll() as $process) {
			$this->stop($process->getPid());
		}
	}
}
