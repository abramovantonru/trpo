<?
const fileInputName = 'LOG_FILE';

if(isset($_FILES[fileInputName]['tmp_name']) && !empty($_FILES[fileInputName]['tmp_name'])){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/log/parser.php';
	$filePath = $_FILES[fileInputName]['tmp_name'];
	echo '<pre>';
	print_r($filePath);
	echo '</pre>';

	$requests = getRequestsList($_SERVER['DOCUMENT_ROOT'] . '/output/2016.log');
	parseRequest($requests);
	$stats = getRequestCountPerDay($requests);

	echo '<pre>';
	print_r($stats);
	echo '</pre>';

	unlink($filePath);
}

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
	<form enctype="multipart/form-data" method="post" action="">
		<div>
			<div>
				<label for="<?= fileInputName ?>">Выберите файл с логом</label>
			</div>
			<div>
				<input type="file" name="<?= fileInputName ?>" id="<?= fileInputName ?>"/>
			</div>
		</div>
		<div>
			<input type="submit" value="Загрузить" class="upload-btn"/>
		</div>
	</form>
</div>

</body>
</html>