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

<h1>User Login:</h1>

<form method="POST" action="/form.php">
	<p>
		<label for="name">Username</label>
		<input id="name" name="username" type="text" placeholder="username" required>
	</p>
	<p>
		<label for="pass">Password</label>
		<input id="pass" name="password" type="password" placeholder="password">
	</p>
	<p>
		<button type="submit">Log In</button>
	</p>

<h1>Email us:</h1>	


<form method="POST" action="/form.php">
	<p>
		<label for="name">To</label>
		<input id="name" name="name" type="text" placeholder="to" required>
	</p>
	<p>
		<label for"name">From</label>
		<input id="name" name="name" type="text" placeholder="from" required>
	</p>
	<p>
		<label for="name">Subject</label>
		<input id="name" name="name" type="text" placeholder="subject">
	<p>
<!-- 		<input id="email" name="email" type="text" placeholder="email">
 -->	</p>
	<!-- <p>
		<label for="pass">Password</label>
		<input id="pass" name="password" type="password" placeholder="Password">
	</p> -->
	<p>
		<!-- <label for="body">Text Body</label> -->
		<textarea name="post_body" rows="5" cols="80" id="body"></textarea>
	</p>
	<p>
<!-- 		<input type="submit" name="submit">
 -->		<button type="submit">send</button>
	</p>
	
</form>
</body>
</html>