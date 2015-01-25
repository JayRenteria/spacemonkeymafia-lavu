<?php
//
require_once("php/misc/config.php");
require_once("php/classes/reservation.php");

$reservations = null;

//connect to mySQL and populate the database
try {
// tell mysqli to throw exceptions
mysqli_report(MYSQLI_REPORT_STRICT);

// now go ahead and connect
$mysqli = new mysqli("localhost", USER_NAME, USER_PASS, USER_NAME);

// get the reservations
$reservations = Reservation::getReservations($mysqli);
} catch(Exception $exception) {
echo "Exception: " . $exception->getMessage() . "<br/>";
echo $exception->getFile() .":" . $exception->getLine();
}

var_dump($reservations);
//echo '<div class="border-wrapper">';
//	echo '<h2>Reservation done!</h2>';
//	echo '<br/>';
foreach($reservations as $reservation) {
//	echo '<p>Name: ' . $reservation->getGuestName() . '</p>';
//	echo '<p>Email: ' . $reservation->getEmail() . '</p>';
//	echo '<p>Phone: ' . $reservation->getPhone() . '</p>';
//	echo '<p>Date: ' . $reservation->getReservationDate() . '</p>';
//	echo '<p>Time: ' . $reservation->getReservationTime() . '</p>';
}

?>

	<a href="<?php echo 'https://' . dirname($_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']); ?>">Click here to go home!</a>
</div>

