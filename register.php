<?php

require_once 'dbconfig.php';
require_once 'settings.php';
require_once 'src/facebook.php';

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pe){
	die("Could not connect to the database $dbname: " . $pe->getMessage());
}

$f_name = "";
$l_name = "";
$password = null;
$email = "";
$fb_id = null;
$date = date_format(new DateTime('now'), ('Y-m-d'));
$city = null;
$state = null;
$country = null;

if(isset($_REQUEST["first_name"])) {
	$f_name = $_REQUEST['first_name'];
	$f_name = trim($f_name);
}

if(isset($_REQUEST['last_name'])) {
	$l_name = $_REQUEST['last_name'];
	$l_name = trim($l_name);
}

if(isset($_REQUEST['email'])) {
	$email = $_REQUEST['email'];
	$email = trim($email);
}

if(isset($_REQUEST['fb_id'])) {
	$fb_id = $_REQUEST['fb_id'];
	$fb_id = trim($fb_id);
}

if(isset($_REQUEST['password'])) {
	$password = $_REQUEST['password'];
	$password = md5(trim($password));
}

if(isset($_REQUEST['city'])) {
	$city = $_REQUEST['city'];
	$city = trim($city);
}

if(isset($_REQUEST['state'])) {
	$state = $_REQUEST['state'];
	$state = trim($state);
}

if(isset($_REQUEST['country'])) {
	$country = $_REQUEST['country'];
	$country = trim($country);
}

echo("Data: " . $f_name . " " . $l_name . " " . $email . " " . $fb_id . " " . $password . "\n");

try {

	$sql = 'INSERT INTO users(fb_id, f_name, l_name, email, reg_date, city, state, country)
					VALUES(:fb_id, :f_name, :l_name, :email, :reg_date, :city, :state, :country)';

	// $password = hash('sha256', $salt + $password);

	// $_h = create_hash($_p);

	$task = array(
				':fb_id' => $fb_id,
				':f_name' => $f_name,
				':l_name' => $l_name,
				':email' => $email,
				':reg_date' => $date,
				':city' => $city,
				':state' => $state,
				':country' => $country
				);

	$q = $conn->prepare($sql);

	$q->execute($task);

	echo("Welcome " . $f_name . " " . $l_name . "!\n");
	echo("FB_ID: " . $fb_id . "\n");

} catch (PDOException $pe) {
	// die("Error registering user: " . $pe->getCode());
	if($pe->getCode() == 23000) {
		echo($pe);
		echo("You already exist in the database!");
		// echo("<p><a href=\"index.php\">Go back</a></p>");
	} else {
		echo($pe);
	}
}

$conn = null;

?>