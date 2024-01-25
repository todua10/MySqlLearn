<?php
    $title = "Регистрация";
    require_once "blocks/header.php";
?>
<div class="container mt-3">
    <h1><?=$title?></h1>
    <br>
    <!-- Форма регистрации пользователя -->
    <form action="send_post.php" method="post">
		<label><b>Имя пользователя</b></label><br>
        <br>
		<input type="text" name="username" placeholder="Введите имя пользователя" size="30"><br>
		<br>
		<label><b>Пароль</b></label><br>
		<br>
        <input type="password" name="password" placeholder="Введите пароль"><br>
        <br>
		<input type="submit" value="Зарегистрироваться" class="btn btn-success">
    </form>
    <br>
</div>

<?php
    require_once "blocks/footer.php";
?>