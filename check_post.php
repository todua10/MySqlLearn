<?php
	// Старт сессии для сохранения ID пользователя
	session_start();
	// Включения файла с классом подключения к БД
    require_once "db.php";
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$conn = new DBConn();
	$conn->connect('localhost', 'root', 'root', 'test');
	$id = $conn->mysql->query("SELECT `id` FROM `users` WHERE username = '$username' AND password = '$password'");
	$id = mysqli_fetch_all($id);
	// Проверка на существование пользователя
	if ($id == null){
		header('Location: index.php');
		exit;
	}
	else{
		$_SESSION["ID"] = $id[0][0];
		header('Location: import.php');
	}