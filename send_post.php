<?php
	// Включения файла с классом подключения к БД
    require_once "db.php";
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$conn = new DBConn();
	$conn->connect('localhost', 'root', 'root', 'test');
	// Регистрация пользователя в БД
	$conn->mysql->query("INSERT INTO
						`users`
								(`username`,
								`password`)
						VALUES 
								('$username',
								'$password')");
?>
<script>
	// Сообщение об успешной регистрации пользователя
	alert("Пользователь зарегистрирован.")
	window.location.href = 'index.php';
</script>