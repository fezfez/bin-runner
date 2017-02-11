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
use BinRunner\ProcessServiceFactory;
use BinRunner\ProcessDAOFactory;

/**
 * Start command.
 *
 * @author St�phane Demonchaux
 */
class StartCommandFactory
{
	public static function getInstance()
	{
		return new StartCommand(ProcessServiceFactory::getInstance(), ProcessDAOFactory::getInstance());
	}
}
