<?php
    $title = "Вход";
    require_once "blocks/header.php";
?>
<div class="container mt-3">
	<h1><?=$title?></h1>
	<br>
	<!-- Форма входа для пользователя-->
	<form action="check_post.php" method="post">
		<label><b>Имя пользователя</b></label><br>
		<br>
        <label>
            <input type="text" name="username" placeholder="Введите имя пользователя" size="30">
        </label><br>
		<br>
		<label><b>Пароль</b></label><br>
		<br>
        <label>
            <input type="password" name="password" placeholder="Введите пароль">
        </label>
        <br>
		<br>
		<input type="submit" value="Войти" class="btn btn-success">
	</form>
	<br>
</div>
<?php
	
	require_once "blocks/footer.php";
?>