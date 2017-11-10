<?
if(isset($_POST['start']) && !empty($_POST['start'])){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/log/generator.php';
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="wrapper">
	<p><?= $response ?></p>
	<a href="/upload">Загрузить лог</a>
</div>

</body>
</html>