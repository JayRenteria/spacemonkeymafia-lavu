<?php
// available times
// availableTimes

require_once("php/classes/reservation.php");

$reservations = null;

//connect to mySQL and populate the database
try {
	// tell mysqli to throw exceptions
	mysqli_report(MYSQLI_REPORT_STRICT);

	// now go ahead and connect
	$mysqli = new mysqli("localhost", '', '', '');

	// get the reservations
	$reservations = Reservation::getReservations($mysqli);
} catch(Exception $exception) {
	echo "Exception: " . $exception->getMessage() . "<br/>";
	echo $exception->getFile() .":" . $exception->getLine();
}

echo "<table border='1' class='table'>
<tr>
<th>Guest Name</th>
<th>Date</th>
<th>Time</th>
<th>Number of Guests</th>
</tr>";
//echo date('m-d-Y h:i:s') . "<br>";
//echo date('m-d-Y h:i:s', date("m-d-Y h:i:s") - 60 * 60 * 2);

foreach($reservations as $reservation) {
	$newDate = explode(" ", $reservation->getReservationDate()->format('m-d-Y'));
	$newDate = $newDate[0];
	$time = $reservation->getReservationTime();

//  if($time < date('h:i:s', date("h:i:s") - 60 * 60 * 2)) {
//    continue;
//  }
	echo "<tr>";
	echo "<td>" . $reservation->getGuestName() . "</td>";
	echo "<td>" . $newDate . "</td>";
	echo "<td>" . $reservation->getReservationTime() . "</td>";
	echo "<td>" . $reservation->getNumOfGuests() . "</td>";
	echo "</tr>";
}
echo "</table>";

?>
