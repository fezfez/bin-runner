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

class ProcessServiceFactory
{
	public static function getInstance()
	{
		return new ProcessService(ProcessDAOFactory::getInstance(), ProcessManagerFactory::getInstance());
	}
}
