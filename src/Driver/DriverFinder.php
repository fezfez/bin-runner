<?php
namespace BinRunner\Driver;

class DriverFinder
{
	public function find()
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return new WindowsDriver();
		}
		
		throw new DriverNotFoundException();
	}
}