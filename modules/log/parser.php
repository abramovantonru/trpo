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
	$days = getDaysArray($requests[0][1]);

	foreach ($requests as $idx => $request){
		$date = DateTime::createFromFormat('d.m.Y H:i:s', $request[1])->format('d.m.Y H');
		if(isset($days[$date]))
			$days[$date]++;
	}

	return $days;
}

/**
 * @param $start_date
 * @return array
 */
function getDaysArray($start_date){
	$days = [];
	$date = DateTime::createFromFormat('d.m.Y H:i:s', $start_date);

	for ($d = 0; $d < days; $d++){
		for ($h = 0; $h < 24; $h++){
			$days[$date->format('d.m.Y H')] = 0;
			$date->modify('+1 hour');
		}
	}

	return $days;
}