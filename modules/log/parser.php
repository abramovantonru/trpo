<?

/**
 * @param $filepath
 * @return array
 */
function getRequestsList($filepath){
	$requests = [];
	$handle = fopen($filepath, 'r');
	if ($handle) {
		while (($line = fgets($handle)) !== false)
			if($line !== PHP_EOL)
				$requests[] = $line;

		fclose($handle);
	}
	return $requests;
}

/**
 * @param $requests
 */
function parseRequest(&$requests){
	foreach ($requests as $idx => $request)
		$requests[$idx] = explode(' -- ', $request);
}

/**
 * @param $requests
 * @return array
 */
function getRequestCountPerDay($requests){
	$days = [];
	foreach ($requests as $idx => $request){
		$date = DateTime::createFromFormat('d.m.Y H:i:s', $request[1])->format('d.m.Y H');
		if(isset($days[$date]))
			$days[$date]++;
		else
			$days[$date] = 1;
	}
	return $days;
}

/**
 * @return bool|null|string
 */
function createTempDir() {
	$tmpDir = sys_get_temp_dir();
	$tempfile = tempnam($tmpDir, '');

	if (file_exists($tempfile))
		unlink($tempfile);
	mkdir($tempfile);
	if (is_dir($tempfile))
		return $tempfile;
	else
		return null;
}

