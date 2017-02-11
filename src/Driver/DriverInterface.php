<?php
namespace BinRunner\Driver;

interface DriverInterface
{
	public function isRunning($pid);
	
	public function stop($pid);
}