<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/core.php';
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
	<form enctype="multipart/form-data" method="post" action="/parse.php">
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