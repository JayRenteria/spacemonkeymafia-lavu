<?php
/**
 * Space Monkey Mafia, Lavu Hackathon.  Reservations information.
 *
 * This is where the reservations information is stored.
 *
 * @author Space Monkey Mafia
 */
class Reservation {
	/**
	 * date of reservation
	 */
	private $reservationDate;
	/**
	 * time of reservation
	 */
	private $reservationTime;
	/**
	 * This will tally the number of reservations within a time slot
	 */
	private $reservationCount;
	/**
	 * name of guest
	 */
	private $guestName;
	/**
	 * number of guests in party
	 */
	private $numOfGuests;
	/**
	 * email of guest
	 */
	private $email;
	/**
	 * phone number of guest
	 */
	private $phone;

	/**
	 * constructor for reservation
	 *
	 * @param datetime $newReservationDate date of reservation
	 * @param datetime $newReservationTime time of reservation
	 * @param int $newReservationCount tally of reservations made within a time slot
	 * @param string $newGuestName name or full name of guest
	 * @param int $newNumOfGuests number of guests in party
	 * @param string $newEmail email of guest
	 * @param string $newPhone phone number of guest
	 * @throws InvalidArgumentException if data types are invalid
	 * @throws RangeException if data values are out of bounds
	 */
	public function __construct($newReservationDate, $newReservationTime, $newReservationCount, $newGuestName, $newNumOfGuests, $newPhone, $newEmail=null) {
		// use the mutators to do the work for us
		try {
			$this->setReservationDate($newReservationDate);
			$this->setReservationTime($newReservationTime);
			$this->setReservationCount($newReservationCount);
			$this->setGuestName($newGuestName);
			$this->setNumOfGuests($newNumOfGuests);
			$this->setEmail($newEmail);
			$this->setPhone($newPhone);
		} catch(InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			// rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));
		}
	}

	/**
	 * accessor method for reservation date
	 *
	 * @return datetime value of reservation date
	 */
	public function getReservationDate() {
		return ($this->reservationDate);
	}

	/**
	 * mutator method for reservation date
	 *
	 * @param datetime $newReservationDate new value of reservation date
	 * @throws InvalidArgumentException if $newReservationDate is not a valid object or string
	 * @throws RangeException if $newReservationDate is a date that does not exist
	 */
	public function setReservationDate($newReservationDate) {
		// base case: if the date is null, use the current date and time
		if($newReservationDate === null) {
			$this->reservationDate = new DateTime();
			return;
		}
		// base case: if the date is a DateTime object, there's no work to be done
		if(is_object($newReservationDate) === true && get_class($newReservationDate) === "DateTime") {
			$this->reservationDate = $newReservationDate;
			return;
		}

		// treat the date as a mySQL date string: Y-m-d H:i:s
		$newReservationDate = trim($newReservationDate);
		if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $newReservationDate, $matches)) !== 1) {
			throw(new InvalidArgumentException("reservation date is not a valid date"));
		}

		// verify the date is really a valid calendar date
		$year = intval($matches[1]);
		$month = intval($matches[2]);
		$day = intval($matches[3]);
		$hour = intval($matches[4]);
		$minute = intval($matches[5]);
		$second = intval($matches[6]);
		if(checkdate($month, $day, $year) === false) {
			throw(new RangeException("reservation date $newReservationDate is not a Gregorian date"));
		}

		// verify the time is really a valid wall clock time
		if($hour < 0 || $hour >= 24 || $minute < 0 || $minute >= 60 || $second < 0 || $second >= 60) {
			throw(new RangeException("reservation date $newReservationDate is not a valid time"));
		}

		// store the reservation date
		$newReservationDate = DateTime::createFromFormat("Y-m-d H:i:s", $newReservationDate);
		$this->reservationDate = $newReservationDate;
	}

	/**
	 * accessor method for reservation time
	 *
	 * @return datetime value reservation time
	 */
	public function getReservationTime() {
		return ($this->reservationTime);
	}

	/**
	 * mutator method for new reservation time
	 *
	 * @param datetime $newReservationTime new reservation time
	 * @throws InvalidArgumentException if $newReservationTime is not a valid object or string
	 * @throws RangeException if $newReservationTime is a date that does not exist
	 */
	public function setReservationTime($newReservationTime) {
		// base case: if the date is null, use the current date and time
		if($newReservationTime === null) {
			$this->reservationTime = new DateTime();
			return;
		}

		// base case: if the date is a DateTime object, there's no work to be done
		if(is_object($newReservationTime) === true && get_class($newReservationTime) === "DateTime") {
			$this->reservationTime = $newReservationTime;
			return;
		}

		// treat the date as a mySQL date string: H:i:s
		$newReservationTime = trim($newReservationTime);
		if((preg_match("/^(\d{2}):(\d{2}):(\d{2})$/", $newReservationTime, $matches)) !== 1) {
			throw(new InvalidArgumentException("reservation time is not a valid date"));
		}

		// verify the date is really a valid calendar date
		$hour = intval($matches[1]);
		$minute = intval($matches[2]);
		$second = intval($matches[3]);

		// verify the time is really a valid wall clock time
		if($hour < 0 || $hour >= 24 || $minute < 0 || $minute >= 60 || $second < 0 || $second >= 60) {
			throw(new RangeException("reservation time $newReservationTime is not a valid time"));
		}

		// store the reservation time
		$this->reservationTime = $newReservationTime;
	}


	/**
	 * accessor method for reservation count
	 *
	 * @return int value reservation count
	 */
	public function getReservationCount() {
		return ($this->reservationCount);
	}

	/**
	 * mutator method for reservation count
	 *
	 * @param int $newReservationCount new reservation count
	 * @throws InvalidArgumentException if $newReservationCount is not an integer
	 * @throws RangeException if $newReservationCount is not positive
	 */
	public function setReservationCount($newReservationCount) {
		// verify reservation count is valid
		$newReservationCount = filter_var($newReservationCount, FILTER_VALIDATE_INT);
		if($newReservationCount === false) {
			throw(new InvalidArgumentException("reservation count is not a valid integer"));
		}

		// verify reservation count is positive
		if($newReservationCount <= 0) {
			throw(new RangeException("reservation count is not positive"));
		}

		// convert and store reservation count
		$this->reservationCount = intval($newReservationCount);
	}

	/**
	 * accessor method for guest name
	 *
	 * @return string value guest name
	 */
	public function getGuestName() {
		return ($this->guestName);
	}

	/**
	 * mutator method for guest name
	 *
	 * @param string $newGuestName new guest name making reservation
	 * @throws InvalidArgumentException if $newGuestName is not a string or insecure
	 * @throws RangeException if $newGuestName is > 25 characters
	 */
	public function setGuestName($newGuestName) {
		// verify guest name is valid
		$newGuestName = trim($newGuestName);
		$newGuestName = filter_var($newGuestName, FILTER_SANITIZE_STRING);
		if(empty($newGuestName) === true) {
			throw(new InvalidArgumentException("guest name content is empty or insecure"));
		}

		// verify guest name does not exceed 25 characters
		if(strlen($newGuestName) > 64) {
			throw(new RangeException("guest name content too large"));
		}

		// store guest name
		$this->guestName = $newGuestName;
	}

	/**
	 * accessor method for number of guests
	 *
	 * @return int value number of guests
	 */
	public function getNumOfGuests() {
		return ($this->numOfGuests);
	}

	/**
	 * mutator method for number of guests
	 *
	 * @param int $newNumOfGuests number of guests
	 * @throws InvalidArgumentException if $newNumOfGuests is not an integer
	 * @throws RangeException if $newNumOfGuests is not positive
	 */
	public function setNumOfGuests($newNumOfGuests) {
		// verify number of guests is valid
		$newNumOfGuests = filter_var($newNumOfGuests, FILTER_VALIDATE_INT);
		if($newNumOfGuests === false) {
			throw(new InvalidArgumentException("number of guests count is not a valid integer"));
		}

		// verify number of guests is positive
		if($newNumOfGuests <= 0) {
			throw(new RangeException("number of guests count is not positive"));
		}

		// convert and store number of guests
		$this->numOfGuests = intval($newNumOfGuests);
	}
	/**
	 * accessor method for email
	 *
	 * @return string value email
	 */
	public function getEmail() {
		return ($this->email);
	}

	/**
	 * mutator method for email
	 *
	 * @param string $newEmail new guest email
	 * @throws InvalidArgumentException if $newEmail is not a string or insecure
	 * @throws RangeException if $newEmail is > 65 characters
	 */
	public function setEmail($newEmail) {
		// verify email is valid
		$newEmail = trim($newEmail);
		$newEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);
		echo 'newMail:'.$newEmail;
		if(empty($newEmail) === true) {
			throw(new InvalidArgumentException("email content is empty or insecure"));
		}

		// verify email does not exceed 65 characters
		if(strlen($newEmail) > 65) {
			throw(new RangeException("email content too large"));
		}

		// store email
		$this->email = $newEmail;
	}
	/**
	 * accessor method for phone
	 *
	 * @return string value phone
	 */
	public function getPhone() {
		return ($this->phone);
	}

	/**
	 * mutator method for phone
	 *
	 * @param string $newPhone new guest phone number
	 * @throws InvalidArgumentException if $newPhone is not a string or insecure,
	 * @throws RangeException if $newPhone is > 10 characters
	 */
	public function setPhone($newPhone) {
		// verify email is valid
		$newPhone = trim($newPhone, "-()");
		$newPhone = filter_var($newPhone, FILTER_SANITIZE_STRING);
		if(empty($newPhone) === true) {
			throw(new InvalidArgumentException("phone content is empty or insecure"));
		}

		// verify email does not exceed 10 characters
		if(strlen($newPhone) > 10) {
			throw(new RangeException("phone content too large"));
		}

		// store email
		$this->phone = $newPhone;
	}
	/**
	 * inserts a reservation into mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function insert(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// create query template
		$query = "INSERT INTO reservation(reservationDate, reservationTime, reservationCount, guestName, numOfGuests, email, phone) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the reservation variables to the place holders in the template
		$formattedDate = $this->reservationDate->format("Y-m-d H:i:s");
		$wasClean = $statement->bind_param("ssisiss", $formattedDate, $this->reservationTime, $this->reservationCount, $this->guestName, $this->numOfGuests, $this->email, $this->phone);
		if($wasClean === false) {
			throw(new mysqli_sql_exception("unable to bind parameters"));
		}

		// execute the statement
		if($statement->execute() === false) {
			throw(new mysqli_sql_exception("unable to execute mySQL statement: " . $statement->error));
		}

		// clean up the statement
		$statement->close();
	}

	/**
	 * deletes a reservation from mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function delete(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// create query template
		$query = "DELETE FROM reservation WHERE reservationDate = ? AND reservationTime = ? AND guestName = ? AND email = ? AND phone = ?";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the reservation variables to the place holder in the template
		$wasClean = $statement->bind_param("sssss", $this->reservationDate, $this->reservationTime, $this->guestName, $this->email, $this->phone);
		if($wasClean === false) {
			throw(new mysqli_sql_exception("unable to bind parameters"));
		}

		// execute the statement
		if($statement->execute() === false) {
			throw(new mysqli_sql_exception("unable to execute mySQL statement: " . $statement->error));
		}

		// clean up the statement
		$statement->close();
	}

	/**
	 * updates a reservation in mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function update(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// create query template
		$query = "UPDATE reservation SET reservationDate = ?, reservationTime = ?, reservationCount = ?, guestName = ?, numOfGuests = ?, email = ?, phone = ? WHERE reservationDate = ? AND reservationTime = ? AND guestName = ?";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the reservation variables to the place holders in the template
		$wasClean = $statement->bind_param("ssisiss", $this->reservationDate, $this->reservationTime, $this->reservationCount, $this->guestName, $this->numOfGuests, $this->email, $this->phone);
		if($wasClean === false) {
			throw(new mysqli_sql_exception("unable to bind parameters"));
		}

		// execute the statement
		if($statement->execute() === false) {
			throw(new mysqli_sql_exception("unable to execute mySQL statement: " . $statement->error));
		}

		// clean up the statement
		$statement->close();
	}


public static function getReservations(&$mysqli, $reservationDate=null, $reservationTime=null) {
	// handle degenerate cases
	if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
		throw(new mysqli_sql_exception("input is not a mysqli object"));
	}

	// sanitize the description before searching
//	$tweetContent = trim($tweetContent);
//	$tweetContent = filter_var($tweetContent, FILTER_SANITIZE_STRING);

	// create query template
	if($reservationDate !== null && $reservationTime !== null) {
		$query = "SELECT guestName, reservationDate, reservationTime, numOfGuests, reservationCount, email, phone FROM reservation WHERE reservationDate = ? AND reservationTime = ?";
	} else if($reservationDate !== null) {
		$query = "SELECT guestName, reservationDate, reservationTime, numOfGuests, reservationCount, email, phone FROM reservation WHERE reservationDate = ?";
	} else {
		$query = "SELECT guestName, reservationDate, reservationTime, numOfGuests, reservationCount, email, phone FROM reservation";
	}
	$statement = $mysqli->prepare($query);
	if($statement === false) {
		throw(new mysqli_sql_exception("unable to prepare statement"));
	}
	// bind the tweet content to the place holder in the template
	if($reservationDate !== null && $reservationTime !== null) {
		$wasClean = $statement->bind_param("ss", $reservationDate, $reservationTime);
	} else if($reservationDate !== null) {
		$wasClean = $statement->bind_param("s", $reservationDate);
	} else {
		$wasClean = true;
	}
	if($wasClean === false) {
		throw(new mysqli_sql_exception("unable to bind parameters"));
	}

	// execute the statement
	if($statement->execute() === false) {
		throw(new mysqli_sql_exception("unable to execute mySQL statement: " . $statement->error));
	}

	// get result from the SELECT query
	$result = $statement->get_result();
	if($result === false) {
		throw(new mysqli_sql_exception("unable to get result set"));
	}

	// build an array of tweet
	$reservations = array();
	while(($row = $result->fetch_assoc()) !== null) {
		try {
			if(empty($row["email"])) {
				$reservation	= new Reservation($row["reservationDate"], $row["reservationTime"], $row["reservationCount"], $row["guestName"], $row["numOfGuests"], $row["phone"]);
			} else {
				$reservation = new Reservation($row["reservationDate"], $row["reservationTime"], $row["reservationCount"], $row["guestName"], $row["numOfGuests"], $row["phone"], $row["email"]);
			}
			$reservations[] = $reservation;

		} catch(Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new mysqli_sql_exception($exception->getMessage(), 0, $exception));
		}
	}

	return($reservations);
}
}


?>