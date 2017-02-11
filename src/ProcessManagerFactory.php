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

use BinRunner\Driver\DriverFinder;

class ProcessManagerFactory
{
	public static function getInstance()
	{
		return new ProcessManager((new DriverFinder())->find());
	}
}
