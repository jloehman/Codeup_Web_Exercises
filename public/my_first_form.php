<!DOCTYPE html>
<html>
<head>

<title>"My First HTML Form"</title>

<meta charset="utf-8">
</head>

<body>



<?php
	var_dump($_GET);
	var_dump($_POST);
	?>



<form method="POST">
	<p>
		<label for="name">Username</label>
		<input id="name" name="username" tyoe="text">
	</p>
	<p>
		<label for="pass">Passwords</label>
		<input id="pass" name="password" type="password">
	</p>
	<p>
		<input type="submit">
	</p>
</form>
</body>
</html>