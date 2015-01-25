<?php

// first, require your class
require_once("../misc/reservation.php");
$count = 2;

//var_dump(explode("-", $_POST["date"]));
// h:i:s
$timeExploded = explode(":", $_POST["time"]);

$hours = $timeExploded[0];
// get the minutes with AM
if(strlen($hours) < 2) {
	$hours = '0' . $hours;
}

$minutes = $timeExploded[1];
// Get rid of AM and PM
$minutes = explode("AM", $minutes)[0];

// set the time
if(strpos($minutes,'AM')) {
	$minutes = explode("AM", $minutes)[0];
} else {
	$minutes = explode("PM", $minutes)[0];
}
//var_dump($minutes);
$time = $hours . ':'. $minutes . ':00';
$date = $_POST["date"]. ' ' . $time;

// user the constructor to create an object
$reservation = new Reservation($date, $time, $count, $_POST["name"], $_POST["numberOfGuests"]);

//
// connect to mySQL and populate the database
try {
	// tell mysqli to throw exceptions
	mysqli_report(MYSQLI_REPORT_STRICT);

	// now go ahead and connect
	$mysqli = new mysqli("localhost", '', '', '');

	// now, insert into mySQL
	$reservation->insert($mysqli);

	// finally, disconnect from mySQL
	$mysqli->close();

	// var_dump the result to affirm we got a real primary key
//	var_dump($reservation);
} catch(Exception $exception) {
	echo "Exception: " . $exception->getMessage() . "<br/>";
	echo $exception->getFile() .":" . $exception->getLine();
}

echo json_encode(
	array(
		'name' => $reservation->getGuestName(),
		'email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'date' => $_POST['date'],
		'time' => $_POST['time'],
	)
);


?>