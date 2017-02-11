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

class ProcessDAOFactory
{
	public static function getInstance()
	{
		$path = '.bin-runner/';
		
		if (is_file('.bin-runner')) {
			$path = file_get_contents('.bin-runner').'/';
		}
		
		if (is_file($path)) {
			throw new \InvalidArgumentException(sprintf('"%s" must be a directory', $path));
		}
		
		if (!is_dir($path)) {
			mkdir($path);
		}
		
		return new ProcessDAO($path);
	}
}
