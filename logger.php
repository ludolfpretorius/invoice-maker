<?php 

	function writeToFile($filepath, $details) {
		$file = $filepath;
		$currentFileData = file_get_contents($file);
		$currentFileData .= $details . PHP_EOL;
		file_put_contents($file, $currentFileData);
	}

	function writeToLog() {
		$query = json_decode(file_get_contents('http://ip-api.com/json/' . $_SERVER['REMOTE_ADDR']));
		if ($query && $query->status == 'success') {
			$user = $_SERVER['REMOTE_ADDR'].' - '.date("H:i:s d-m-Y").' - '.$query->country.', '.$query->regionName.', '.$query->city.', '.$query->zip.', '.$query->isp.', '.$query->org.', '.$query->as;
			writeToFile('logs/users.txt', $user);
		} else {
			$user = $_SERVER['REMOTE_ADDR'].' - '.date("H:i:s d-m-Y");
			writeToFile('logs/users.txt', $user);
		}
	}

	writeToLog();