<!--<h2>Available times:</h2>-->
<!--<ul class="list-group">-->
<!--	<li class="list-group-item">7 PM</li>-->
<!--	<li class="list-group-item">8 PM</li>-->
<!--	<li class="list-group-item">Morbi leo risus</li>-->
<!--	<li class="list-group-item">Porta ac consectetur ac</li>-->
<!--	<li class="list-group-item">Vestibulum at eros</li>-->
<!--</ul>-->


<?php
$con=mysqli_connect("localhost","nlopez","cedaraoshorerhinedrill","nlopez");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT guestName, reservationDate, reservationTime, numOfGuests FROM reservation");

echo "<table border='1' class='table'>
<tr>
<th>Guest Name</th>
<th>Reservation Date</th>
<th>Reservation Time</th>
<th>Number of Guests</th>
</tr>";


while($row = mysqli_fetch_array($result))
{
	$newDate = explode(" ", $row['reservationDate']);
	$newDate = $newDate[0];
	echo "<tr>";
	echo "<td>" . $row['guestName'] . "</td>";
	echo "<td>" . $newDate . "</td>";
	echo "<td>" . $row['reservationTime'] . "</td>";
	echo "<td>" . $row['numOfGuests'] . "</td>";
	echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>