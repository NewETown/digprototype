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

$_arr = null;
$fb_id = 0;

if(isset($_REQUEST['arr'])) {
	$_arr = $_REQUEST['arr'];
	$_arr = json_decode($_arr);
}

if(isset($_REQUEST['fb_id'])) {
	$fb_id = $_REQUEST['fb_id'];
}

// {"category":"Musician/band","name":"Jay Z","created_time":"2014-02-19T17:14:34+0000","id":"48382669205"}

$_id; $_category; $_name;
$_arrSize = count($_arr);

for($i = 0; $i < $_arrSize; $i++) {

	$_id = $_arr[$i]->id;
	$_id = $_id + 0;
	$_name = $_arr[$i]->name;
	$_category = $_arr[$i]->category;
	echo($_id . "\n"); // . $_name . " " . $_category . "\n");

	try {
		$sql = 'INSERT INTO interests(id, name, category)
						VALUES(:_id, :_name, :_category)';

		$task = array(
					':_id' => $_id, 
					':_name' =>  $_name,
					':_category' => $_category
					);

		$q = $conn->prepare($sql);

		$q->execute($task);

	} catch (PDOException $pe) {
		if($pe->getCode() == 23000)
			echo("duplicate");
		else
			echo("Something went wrong!");
	}

	try {
		$sql = 'INSERT INTO interest_map(fb_id, interest_id)
						VALUES(:fb_id, :interest_id)';

		$task = array(
					':fb_id' => $fb_id, 
					':interest_id' =>  $_id
					);

		$q = $conn->prepare($sql);

		$q->execute($task);

	} catch (PDOException $pe) {
		echo($pe);
	}
}

$conn = null;

?>