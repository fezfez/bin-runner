<?php

/**
 * This file is part of the PHP to Zephir package.
 *
 * (c) Stéphane Demonchaux <demonchaux.stephane@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BinRunner;

class Process
{
	private $pid;
	private $alias;
	private $command;
	
	public function __construct($pid, $alias, $command)
	{
		$this->pid = $pid;
		$this->alias = $alias;
		$this->command = $command;
	}
	
	public function getPid()
	{
		return $this->pid;
	}
	
	public function getAlias()
	{
		return $this->alias;
	}
	
	public function getCommand()
	{
		return $this->command;
	}
}
