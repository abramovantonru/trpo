<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/class/UserInfo.php';
use Log\Generator\UserInfo;

$start = $_GET['start'] . ' 00:00:00'; // start date

$cachedClients = [];
$requests = [];
$day = 86400;
$hour = 3600;

$Y = DateTime::createFromFormat('d.m.Y', $_GET['start'])->format('Y');
$filename = $_SERVER['DOCUMENT_ROOT'] . '/output/' . $Y . '.log';

define('settings', [
	// вс
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	// пн
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	// вт
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	// ср
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	// чт
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	// пт
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
	//сб
	[
		[120, 200], [80, 100], [20, 30], [10, 20], [0, 10], [0, 5], [0, 10], [0, 20], [10, 30], [20, 40], [65, 70], [100, 200], // 11
		[110, 210], [90, 210], [110, 210], [110, 210], [150, 250], [180, 300], [200, 250], [150, 280], [140, 250], [140, 250], [150, 210], [130, 220],
	],
]);

$day_timestamp = DateTime::createFromFormat('d.m.Y H:i:s', $start)->getTimestamp();
for($d = 0; $d < days; $d++){
	$w = date('w', $day_timestamp); // день недели с вс
	for ($h = 0; $h < 24; $h++){
		$content = '';
		$requests = [];
		$count = rand(settings[$w][$h][0], settings[$w][$h][1]);
		$max_timestamp = $day_timestamp + $hour - 1;

		for($i = 0; $i < $count; $i++){
			$rndReplayConnect = rand(0, 4);
			if($rndReplayConnect == 0){ // 1 из 5 генерируется новый IP
				$client = new UserInfo($day_timestamp, $max_timestamp);
				$cachedClients[] = $client;
			}else{// 4 из 5 старых IP
				$clientsCount = count($cachedClients);
				if($clientsCount > 10){ // если уже есть клиенты
					$rndClientIdx = rand(0, $clientsCount - 1);
					$client = clone $cachedClients[$rndClientIdx];
					$client->reRandom($day_timestamp, $max_timestamp);
					$cachedClients[$rndClientIdx] = $client; // сохраняем
				}else{ // если клиентов ещё не было
					$client = new UserInfo($day_timestamp, $max_timestamp);
					$cachedClients[] = $client;
				}
			}

			$requests[] = $client;
		}

		usort($requests, ['Log\Generator\UserInfo', 'sortByTimestamp']);

		foreach ($requests as $request)
			$content .= $request->ip . ' -- ' . date('d.m.Y H:i:s', $request->timestamp) . ' -- ' . $request->page . ' -- ' . $request->agent . PHP_EOL;

		file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);

		$day_timestamp += $hour;
	}
}

echo 'Лог-файл веб-ресурса для ' . $Y . ' года успешно сгенерирован!';