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

class ProcessDAO
{
	private $path;
	
	public function __construct($path)
	{
		$this->path = $path;
	}

	public function findAll()
	{
		$processCollection = [];
		
		foreach (glob($this->path.'*.json') as $processFile) {
			$process = json_decode(file_get_contents($processFile), true);
			if ($process !== null) {
				$processCollection[] = new Process($process['pid'], $process['alias'], $process['command']);
			}
		}
		
		return $processCollection;
	}
	
	public function insert($pid, $command, $alias)
	{
		file_put_contents($this->path.$pid.'.json', json_encode(['pid' => $pid, 'alias' => $alias, 'command' => $command]));
	}
	
	public function find($aliasOrPid)
	{
		$processCollection = $this->findAll();
		
		foreach ($processCollection as $proces) {
			if (in_array($aliasOrPid, [$proces->getAlias(), $proces->getPid()])) {
				return $proces;
			}
		}
		
		throw new ProcessNotFoundException(sprintf('Process "%s" not found', $aliasOrPid));
	}
	
	public function findByCommand($command)
	{
		$processCollection = $this->findAll();
		
		foreach ($processCollection as $proces) {
			$processCommand = $proces->getCommand();
			if ($command === $processCommand) {
				return $proces;
			}
		}
		
		throw new ProcessNotFoundException(sprintf('Process "%s" not found', $command));
	}
	
	public function remove($pid)
	{
		unlink($this->path.$pid.'.json');
	}
}
