<?php

require_once("php/misc/reservation.php");

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

foreach($reservations as $reservation) {
	$newDate = explode(" ", $reservation->getReservationDate()->format('m-d-Y'));
	$newDate = $newDate[0];
	echo "<tr>";
	echo "<td>" . $reservation->getGuestName() . "</td>";
	echo "<td>" . $newDate . "</td>";
	echo "<td>" . $reservation->getReservationTime() . "</td>";
	echo "<td>" . $reservation->getNumOfGuests() . "</td>";
	echo "</tr>";
}
echo "</table>";

?>
