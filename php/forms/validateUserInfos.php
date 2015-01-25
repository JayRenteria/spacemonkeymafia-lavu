<?php

// first, require your class
echo getcwd();
require_once("../misc/reservation.php");
$count = 2;

//var_dump($_POST);

// Format the time correctly
// yyyy-mm-dd
//var_dump(explode("-", $_POST["date"]));
// h:i:s
$timeExploded = explode(":", $_POST["time"]);

//var_dump($_POST["time"]);
$hours = $timeExploded[0];
// get the minutes with AM
$minutes = $timeExploded[1];
// Get rid of AM
$minutes = explode("AM", $minutes)[0];
//var_dump($minutes);
// set the time
$time = $hours . ':'. $minutes . ':00';
$date = $_POST["date"]. ' ' . $time;
var_dump($date);
var_dump($time);
// user the constructor to create an object
$reservation = new Reservation($date, $time, $count, $_POST["name"], $_POST["numberOfGuests"]);

//
// connect to mySQL and populate the database
//try {
//	// tell mysqli to throw exceptions
//	mysqli_report(MYSQLI_REPORT_STRICT);
//
//	// now go ahead and connect
//
//
//	// now, insert into mySQL
//	$reservation->insert($mysqli);
//
//	// finally, disconnect from mySQL
//	$mysqli->close();
//
//	// var_dump the result to affirm we got a real primary key
//	var_dump($reservation);
//} catch(Exception $exception) {
//	echo "Exception: " . $exception->getMessage() . "<br/>";
//	echo $exception->getFile() .":" . $exception->getLine();
//}
//echo "done!";

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