
<div class="border-wrapper">
	<form id="guestForm" action="page3.php" method="post" novalidate>

		<!-- selection/time dropdown-->
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
			<input class="invisible-input" type="text" value="<?php echo $_POST['name']; ?>" name="<?php echo $_POST['name']; ?>">
			<input class="invisible-input" type="text" value="<?php echo $_POST['email']; ?>" name="<?php echo $_POST['email']; ?>"/>
			<input class="invisible-input" type="text" value="<?php echo $_POST['phone']; ?>" name="<?php echo $_POST['phone']; ?>"/>
			<input class="invisible-input" type="text" value="<?php echo $_POST['date']; ?>" name="<?php echo $_POST['date']; ?>">
			<input class="invisible-input" type="text" value="<?php echo $_POST['numberOfGuests'];?>" name="<?php echo $_POST['numberOfGuests']; ?>"/>
		</div>

	<input type="submit" value="Reserve!" class="btn btn-default">
	</form>

</div><!-- end border-wrapper -->