<?php

function debug_log($str) 
	{

		$data = debug_backtrace();
		$func = $data[1]['function'];
		$data = $data[0];
	
		$file = $data['file'];
		$line = $data['line'];
		$content = $data['args'][0];
		$data = date("Y-d-m-h-i-s");

		$str = "---------------------------------\r\n".$data
			."file[$file] func[$func] line[$line] log[$content]\r\n";
		$fp = fopen("debug.log", "a");
		if (!$fp) 
		{
			die(__FUNCTION__." open file error\n");
		}
		fwrite($fp, $str);
		fclose($fp);
	}
