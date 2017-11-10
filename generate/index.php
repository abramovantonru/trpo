<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="wrapper">
	<form enctype="multipart/form-data" method="post" action="/generate/response.php">
		<div>
			<div>
				<label for="start_date">Выберите файл с логом</label>
			</div>
			<div>
				<input type="date" name="start" id="start_date"/>
			</div>
		</div>
		<div>
			<input type="submit" value="Сгенерировать" class="upload-btn"/>
		</div>
	</form>
</div>

</body>
</html>