<?php
	$title = "Импорт";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="text-center p-3">
	<h1><?=$title?></h1>
	<br>
	<!-- Форма импорта файла -->
	<form action="importexport.php" method="post" enctype="multipart/form-data">
		<label><b>Выберите файл:</b></label><br>
		<br>
		<input type="file" name="myfile"><br>
		<br>
		<input type="submit" value="Импорт" class="btn btn-success"><br>
		<br>
	</form>
	<form action="index.php" method="post">
		<input type="submit" value="Выйти" class="btn btn-danger">
	</form>
	<br>
</div>
<?php
	require_once "blocks/footer.php";
?>