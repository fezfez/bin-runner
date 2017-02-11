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

use BinRunner\Driver\DriverInterface;

class ProcessManager
{
	/**
	 * @var DriverInterface
	 */
	private $driver;
	
	public function __construct(DriverInterface $driver)
	{
		$this->driver = $driver;
	}
	
	public function start($command)
	{
		$process = new SfPRocess($command);
		$process->setTimeout(3600);
		$process->start();
		
		if (!$process->isRunning()) {
			throw new \RuntimeException('Process crash : '. $process->getErrorOutput());
		}
		
		return $process->getPid();
	}
	
	public function stop($pid)
	{
		$this->driver->stop($pid);
	}
}
