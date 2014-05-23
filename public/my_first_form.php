<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>"My First HTML Form"</title>

</head>

<body>

<?php
	var_dump($_GET);
	echo"<br>";
	var_dump($_POST);
?>


<form method="POST" action="/form.php">
	<p>
		<label for="name">Username</label>
		<input id="name" name="username" type="text" placeholder="Username" required>
	</p>
	<p>
		<label for="pass">Passwords</label>
		<input id="pass" name="password" type="password" placeholder="Password">
	</p>
	<p>
		<button type="submit">Log In</button>
	</p>
</form>
</body>
</html>