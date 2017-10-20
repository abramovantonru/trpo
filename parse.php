<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/core.php';

if(isset($_FILES[fileInputName]['tmp_name']) && !empty($_FILES[fileInputName]['tmp_name'])){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/log/parser.php';
	$filePath = $_FILES[fileInputName]['tmp_name'];

	$requests = getRequestsList($filePath);
	parseRequest($requests);
	$stats = getRequestCountPerDay($requests);

	$count = 0;
	foreach ($stats as $c)
		$count += $c;

	unlink($filePath);

	saveValues($_SERVER['DOCUMENT_ROOT'] . '/output/values', $stats);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="wrapper">
	<p>Общее количество запросов: <?= $count ?></p>
</div>

</body>
</html>
<?}

function saveValues($filepath, $stats){
	$content = '';

	foreach ($stats as $val)
		$content .= $val . PHP_EOL;

	$content = substr($content, 0, -1 * strlen(PHP_EOL));

	file_put_contents($filepath, $content);
}

?>