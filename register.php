<?php

require_once 'dbconfig.php';
require_once 'settings.php';

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pe){
	die("Could not connect to the database $dbname: " . $pe->getMessage());
}

$username = "";
$password = "";
$email = "";
$date = date_format(new DateTime('now'), ('Y-m-d'));
$salt = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);

if(isset($_POST['username'])) {
	$username = $_POST['username'];
	$username = trim($username);
}

if(isset($_POST['password'])) {
	$password = $_POST['password'];
	$password = md5(trim($password));
	$_p = $password;
}

if(isset($_POST['email'])) {
	$email = $_POST['email'];
	$email = trim($email);
}

getHeader();

?>

<?php

try {

$sql = 'INSERT INTO users(user_name, password, email, reg_date, salt, long_pw)
				VALUES(:usr, :pass, :email, :reg_date, :salt, :long_pw)';

$password = hash('sha256', $salt + $password);

$_h = create_hash($_p);

$task = array(':usr' => $username,
			  ':email' => $email,
			  ':reg_date' => $date,
			  ':long_pw' => $_h
			  );

$q = $conn->prepare($sql);

$q->execute($task);

echo("<h1>Welcome " . $username . "!</h1>\n");
echo("<p>Hash: " . $password . "</p>");
echo("<p>Hash return: " . $_h . "</p>");
echo("<p>Return length: " . strlen($_h) . "</p>");


} catch (PDOException $pe) {
	// die("Error registering user: " . $pe->getCode());
	if($pe->getCode() == 23000) {
		echo("<p>Sorry that username or email is already used!</p>");
		echo("<p><a href=\"index.php\">Go back</a></p>");
	}
}

$conn = null;

?>

<?php

getFooter();

?>