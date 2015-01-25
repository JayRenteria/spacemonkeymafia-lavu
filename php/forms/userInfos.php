<div class="border-wrapper">
	<form id="guestForm" action="php/forms/validateUserInfos.php" method="post" novalidate>

	<!-- forms for customer name, email, phone number and a date selection/time dropdown-->
		<div class="group">
			<input id="guestName" type="text" name="name" autocomplete="off" required>
			<label>Name</label>
		</div>
		<div class="group">
			<input id="guestEmail" type="text" name="email" autocomplete="off" required>
			<label>Email</label>
		</div>
		<div class="group">
			<input id="guestPhone" type="text" name="phone" autocomplete="off" required>
			<label>Phone</label>
		</div>
		<div class="group">
			<input id="guestDate" type="date" name="date" value="Select a Date"><br>
		</div>
		<div class="group">
			<select id="numberOfGuests" name="numberOfGuests" class="form-control">
				<option value="">How many guests?</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		<div class="group">
			<select id="guestTime" name="time" class="form-control">
				<?php

				require_once("php/misc/config.php");
				require_once("php/classes/reservation.php");
//
//				$reservations = null;
//
//				//connect to mySQL and populate the database
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

//				foreach($reservations as $reservation) {
//					$newDate = explode(" ", $reservation->getReservationDate()->format('m-d-Y'));
//					$newDate = $newDate[0];
//					$time = $reservation->getReservationTime();
//
//					$newTime = date('h:i:s a', strtotime($reservation->getReservationTime()));
//					echo "<tr>";
//					echo "<td>" . $reservation->getGuestName() . "</td>";
//					echo "<td>" . $newDate . "</td>";
//					echo "<td>" . $newTime . "</td>";
//					echo "<td>" . $reservation->getNumOfGuests() . "</td>";
//					echo "</tr>";
//				}

				?>
				<option value="">Select a Time</option>
				<option value="7:00AM">7:00AM</option>
				<option value="7:30AM">7:30AM</option>
				<option value="8:00AM">8:00AM</option>
				<option value="8:30AM">8:30AM</option>
				<option value="9:00AM">9:00AM</option>
				<option value="9:30AM">9:30AM</option>
				<option value="10:00AM">10:00AM</option>
				<option value="10:30AM">10:30AM</option>
				<option value="11:00AM">11:00AM</option>
				<option value="11:30AM">11:30AM</option>
				<option value="12:00PM">12:00PM</option>
				<option value="12:30PM">12:30PM</option>
				<option value="1:00PM">1:00PM</option>
				<option value="1:30PM">1:30PM</option>
				<option value="2:00PM">2:00PM</option>
				<option value="2:30PM">2:30PM</option>
				<option value="3:00PM">3:00PM</option>
				<option value="3:30PM">3:30PM</option>
				<option value="4:00PM">4:00PM</option>
				<option value="4:30PM">4:30PM</option>
				<option value="5:00PM">5:00PM</option>
				<option value="5:30PM">5:30PM</option>
				<option value="6:00PM">6:00PM</option>
				<option value="6:30PM">6:30PM</option>
			</select><br>
		</div>

		<input type="submit" value="Reserve!" class="btn btn-default">
	</form>


	<div id="reservationConfirmationCard">
		<h2>Reservation done!</h2>
		<br/>
		<div id="ajaxResponse">
			<p>Name:</p>
			<p>Email:</p>
			<p>Phone:</p>
			<p>Date:</p>
			<p>Time:</p>
		</div>
	</div>
</div><!-- end border-wrapper -->