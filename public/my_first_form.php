<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>"My First HTML Form"</title>

</head>

<body>



<?php
	var_dump($_GET);
	var_dump($_POST);
	?>



<form method="POST">
	<p>
		<label for="name">Username</label>
		<input id="name" name="username" tyoe="text" placeholder="Username here" required>
	</p>
	<p>
		<label for="pass">Passwords</label>
		<input id="pass" name="password" type="password" placeholder="Password">
	</p>
	<p>
		<input type="submit">
	</p>
</form>
</body>
</html>