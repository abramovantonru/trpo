<?

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
				<label for="image_file">Выберите файл с логом</label>
			</div>
			<div>
				<input type="file" name="image_file" id="image_file"/>
			</div>
		</div>
		<div>
			<input type="submit" value="Загрузить" class="upload-btn"/>
		</div>
	</form>
</div>

</body>
</html>