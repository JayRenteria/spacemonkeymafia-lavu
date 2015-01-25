<?php

// first, require your class
require_once("../misc/reservation.php");

$count = 2;


// user the constructor to create an object
$reservation = new Reservation($_POST["date"], $_POST["time"], $count, $_POST["name"], $_POST["numberOfGuest"]);

//
// connect to mySQL and populate the database
try {
	// tell mysqli to throw exceptions
	mysqli_report(MYSQLI_REPORT_STRICT);

	// now go ahead and connect
	$mysqli = new mysqli("localhost", "nlopez", "cedaraoshorerhinedrill", "nlopez");

	// now, insert into mySQL
	$reservation->insert($mysqli);

	// finally, disconnect from mySQL
	$mysqli->close();

	// var_dump the result to affirm we got a real primary key
	var_dump($reservation);
} catch(Exception $exception) {
	echo "Exception: " . $exception->getMessage() . "<br/>";
	echo $exception->getFile() .":" . $exception->getLine();
}
echo "done!";

//echo json_encode(
//	array(
//		'name' => 'TODO: returName',
//		'email' => 'TODO: returName',
//		'phone' => 'TODO: returName',
//		'date' => 'TODO: returName',
//		'time' => 'TODO: returName',
//	)
//);


?>