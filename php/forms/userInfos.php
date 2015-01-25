<div class="border-wrapper">
	<form id="guestForm" action="page2.php" method="post" novalidate>

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
			<select id="numberOfGuests" name="numberOfGuests" class="form-control" onchange="">
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
</div><!-- end border-wrapper -->