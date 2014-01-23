<?php

require_once 'dbconfig.php';
require_once 'settings.php';

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe){
	die("Could not connect to the database $dbname: " . $pe->getMessage());
}

getHeader();

?>

<div style="margin-top:10%;">
	<h1>Register</h1>
	<form action="register.php" role="form" method="post">
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" name="username" placeholder="Please enter a username">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password" placeholder="Please enter a password">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" name="email" placeholder="Please enter an email">
		</div>
		<button type="submit" class="btn btn-default pull-right">Submit</button>
	</form>
</div>

<div style="margin-top:5%;">
	<h1>Login</h1>
	<form action="login.php" role="form" method="post" class="form-inline">
		<div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Username">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Login</button>
		</div>
	</form>
</div>

<?php

getFooter();

?>