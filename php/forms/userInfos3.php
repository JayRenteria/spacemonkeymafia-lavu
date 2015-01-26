<?php
require_once("php/misc/config.php");
require_once("php/classes/reservation.php");

//var_dump($_POST);

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
$reservation = new Reservation($date, $time, 2, $_POST["name"], $_POST["numberOfGuests"], $_POST["phone"], $_POST["email"]);

//
// connect to mySQL and populate the database
try {
	// tell mysqli to throw exceptions
	mysqli_report(MYSQLI_REPORT_STRICT);

	// now go ahead and connect
	$mysqli = new mysqli("localhost", USER_NAME, USER_PASS, USER_NAME);

	// now, insert into mySQL
	$reservation->insert($mysqli);

	// finally, disconnect from mySQL
	$mysqli->close();

	// var_dump the result to affirm we got a real primary key
//  var_dump($reservation);
} catch(Exception $exception) {
	echo "Exception: " . $exception->getMessage() . "<br/>";
	echo $exception->getFile() .":" . $exception->getLine();
}








//
// NOW let's print everything!
//
$reservations = null;

//connect to mySQL and populate the database
try {
	// tell mysqli to throw exceptions
	mysqli_report(MYSQLI_REPORT_STRICT);

	// now go ahead and connect
	$mysqli = new mysqli("localhost", USER_NAME, USER_PASS, USER_NAME);

	// get the reservations
	$reservations = Reservation::getReservations($mysqli);

	// finally, disconnect from mySQL
	$mysqli->close();
} catch(Exception $exception) {
echo "Exception: " . $exception->getMessage() . "<br/>";
echo $exception->getFile() .":" . $exception->getLine();
}

echo '<div class="border-wrapper">';
		echo '<h2>Reservation done!</h2>';
		echo '<br/>';
if($reservations !== null && empty($reservations) === false) {
	$i = 0;
	foreach($reservations as $reservation) {
		if(++$i === count($reservations)) {
			$newDate = explode(" ", $reservation->getReservationDate()->format('m-d-Y'));
			$newDate = $newDate[0];
			$newTime = date('h:i:s a', strtotime($reservation->getReservationTime()));
			echo '<p>Name: ' . $reservation->getGuestName() . '</p>';
			echo '<p>Email: ' . $reservation->getEmail() . '</p>';
			echo '<p>Phone: ' . $reservation->getPhone() . '</p>';
			echo '<p>Date: ' . $newDate . '</p>';
			echo '<p>Time: ' . $newTime . '</p>';
		}
	}
} else {
	echo 'nada! <br>';
}



?>

	<a href="<?php echo 'https://' . dirname($_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']); ?>">Click here to go home!</a>
</div><!-- end border-wrapper -->

