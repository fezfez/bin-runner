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
use BinRunner\ProcessDAOFactory;
use BinRunner\Driver\DriverFinder;

/**
 * List command.
 *
 * @author St�phane Demonchaux
 */
class ListCommandFactory
{
	public static function getInstance()
	{
		return new ListCommand(ProcessDAOFactory::getInstance(), (new DriverFinder())->find());
	}
}
