<?php
// available times
// availableTimes
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

echo "<table border='1' class='table'>
<tr>
<th>Guest Name</th>
<th>Date</th>
<th>Time</th>
<th>Number of Guests</th>
<th>Phone</th>
</tr>";

if($reservations !== null && empty($reservations) === false) {
	foreach($reservations as $reservation) {
		$newDate = explode(" ", $reservation->getReservationDate()->format('m-d-Y'));
		$newDate = $newDate[0];
		$time = $reservation->getReservationTime();

		$newTime = date('h:i:s a', strtotime($reservation->getReservationTime()));
		$areaCode = substr($reservation->getPhone(), 0, 3);
		$firstThree = substr($reservation->getPhone(), 3, 3);
		$lastFour = substr($reservation->getPhone(), 6, 4);
		$newPhone = $areaCode . " " . $firstThree . " " . $lastFour;
		echo "<tr>";
		echo "<td>" . $reservation->getGuestName() . "</td>";
		echo "<td>" . $newDate . "</td>";
		echo "<td>" . $newTime . "</td>";
		echo "<td>" . $reservation->getNumOfGuests() . "</td>";
		echo "<td>" . $newPhone . "</td>";
		echo "</tr>";
	}
} else {
	echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
	echo '</tr>';
}

echo "</table>";

?>
