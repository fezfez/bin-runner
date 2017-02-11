<?php
namespace BinRunner\Driver;

class WindowsDriver implements DriverInterface
{
	public function isRunning($pid)
	{
		exec(sprintf('tasklist /FO csv /FI "PID eq %s" /NH | findstr /R /C:"%s"', $pid, $pid), $output);
		
		if (empty($output)) {
			return false;
		}
		
		return true;
	}
	
	public function stop($pid)
	{
		exec(sprintf('Taskkill /PID %s /F /t', $pid), $output);
	}
}