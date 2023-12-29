<h3>Шаг 1: Настройка подключения БД</h3>

<form method="post">
	Хост<br>
	<input type="text" name=":HOST:" value="<?= $input[':HOST:']; ?>"><br>
	Порт<br>
	<input type="text" name=":PORT:" value="<?= $input[':PORT:']; ?>"><br>
	Пользователь<br>
	<input type="text" name=":USER:" value="<?= $input[':USER:']; ?>"><br>
	Пароль<br>
	<input type="text" name=":PASS:" value="<?= $input[':PASS:']; ?>"><br>
	База данных<br>
	<input type="text" name=":DBNAME:" value="<?= $input[':DBNAME:']; ?>"><br>
	<br>
	<input type="hidden" name="form" value="form_1">
	<button type="submit" name="step" value="step_1">Применить</button>
</form>
