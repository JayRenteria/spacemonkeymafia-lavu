<?php
$guestTables = array(
	array("Table 1", 2),
	array("Table 2", 2),
	array("Table 3", 4),
	array("Table 4", 4),
	array("Table 5", 6),
);

/**
*
* This is an example of a reservation table service design for a restaurant reservation application
*
* @author David Fevig <davidfevig1@davidfevig.com>
**/
class GuestTables {
	/**
	 * id for the GuestTable; this is the primary key
	 **/
	private $guestTablesId;
	/**
	 * individual numbering of each guestTableNum
	 **/
	private $tableNum;
	/**
	 * capacity of each guest table
	 **/
	private $capacity;


	/**
	 * constructor for this GuestTables
	 *
	 *This is a Place Holder
	 *
	 **/
	public function __construct($newGuestTablesId, $newTableNum, $newCapacity) {
		try {
			$this->setGuestTablesId($newGuestTablesId);
			$this->setTableNum($newTableNum);
			$this->setCapacity($newCapacity);
		} catch(InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			// rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));
		}
	}

	/**
	 * accessor method for guest tables id
	 *
	 * @return int value of id
	 **/
	public function getGuestTablesId() {
		return ($this->guestTablesId);
	}

	/**
	 * mutator method for guest tables id
	 *
	 * @param mixed $newGuestTablesId new value of guest tables id
	 * @throws InvalidArgumentException if $newGuestTableId is not an integer
	 * @throws RangeException if $newGuestTableId is not positive
	 **/
	public function setGuestTablesId($newGuestTablesId) {
		// base case: if the tweet id is null, this a new tweet without a mySQL assigned id (yet)
		if($newGuestTablesId === null) {
			$this->guestTablesId = null;
			return;
		}

		// verify the profile id is valid
		$newGuestTablesId = filter_var($newGuestTablesId, FILTER_VALIDATE_INT);
		if($newGuestTablesId === false) {
			throw(new InvalidArgumentException("guest tables id is not a valid integer"));
		}

		// verify the profile id is positive
		if($newGuestTablesId <= 0) {
			throw(new RangeException("new guest tables id is not positive"));
		}
		// convert and store the profile id
		$this->guestTablesId = intval($newGuestTablesId);
	}

	/**
	 * accessor method for assigned table number
	 *
	 * @return int value of table number
	 **/
	public function getTableNum() {
		return ($this->tableNum);
	}

	/**
	 * mutator method for table number
	 *
	 * @param int $newTableNum new value of table number
	 * @throws InvalidArgumentException if $newTableNum is not an int or positive
	 **/
	public function setTableNum($newTableNum) {
		// verify the table num is valid
		$newTableNum = filter_var($newTableNum, FILTER_VALIDATE_INT);
		if($newTableNum === false) {
			throw(new InvalidArgumentException("table num is not a valid integer"));
		}

		//verify the table number is positive
		if($newTableNum <= 0) {
			throw(new RangeException("table number is not positive"));
		}

		// convert and store the profile id
		$this->getTableNum = intval($newTableNum);
	}

	/**
	 * accessor method for capacity
	 *
	 * @return int value of capacity
	 **/

	public function getCapacity() {
		return ($this->capacity);
	}

	/**
	 * mutator method for capacity
	 *
	 * @param int $newCapacity new value of capacity
	 * @throws InvalidArgumentException if $newCapacity is not an integer
	 * @throws RangeException if $newCapacity is not positive
	 **/
	public function setCapacity($newCapacity) {
		// verify the capacity is valid
		$newCapacity = filter_var($newCapacity, FILTER_VALIDATE_INT);
		if($newCapacity === false) {
			throw(new InvalidArgumentException("capacity is not a valid integer"));
		}

		// verify the capacity is not a negative integer
		if($newCapacity <= 0) {
			throw(new RangeException("capacity is not positive"));
		}

		// convert and store the capacity
		$this->capacity = intval($newCapacity);
	}
	/**
	 * inserts this GuestTables into mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function insert(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// enforce the guestTablesId is null (i.e., don't insert a id that already exists)
		if($this->guestTablesId !== null) {
			throw(new mysqli_sql_exception("not a guestTableId"));
		}

		// create query template
		$query	 = "INSERT INTO guestTables(guestTablesId, tableNum, capacity) VALUES(?, ?, ?)";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the member variables to the place holders in the template
		$wasClean	  = $statement->bind_param("iii", $this->guestTablesId, $this->tableNum, $this->capacity);
		if($wasClean === false) {
			throw(new mysqli_sql_exception("unable to bind parameters"));
		}

		// execute the statement
		if($statement->execute() === false) {
			throw(new mysqli_sql_exception("unable to execute mySQL statement: " . $statement->error));
		}

		// update the null guestTables with what mySQL just gave us
		$this->guestTablesId = $mysqli->insert_id;

		// clean up the statement
		$statement->close();
	}
	/**
	 * deletes this GuestTables from mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function delete(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// enforce the guestTablesId is not null (i.e., don't delete a guest table that hasn't been inserted)
		if($this->guestTablesId === null) {
			throw(new mysqli_sql_exception("unable to delete a guest table that does not exist"));
		}

		// create query template
		$query	 = "DELETE FROM guestTables WHERE guestTablesId = ?";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the member variables to the place holder in the template
		$wasClean = $statement->bind_param("i", $this->guestTablesId);
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
	 * updates the guestTables in mySQL
	 *
	 * @param resource $mysqli pointer to mySQL connection, by reference
	 * @throws mysqli_sql_exception when mySQL related errors occur
	 **/
	public function update(&$mysqli) {
		// handle degenerate cases
		if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
			throw(new mysqli_sql_exception("input is not a mysqli object"));
		}

		// enforce the guestTables is not null (i.e., don't update a guestTables that hasn't been inserted)
		if($this->guestTablesId === null) {
			throw(new mysqli_sql_exception("unable to update a guest table that does not exist"));
		}

		// create query template
		$query	 = "UPDATE guestTables SET guestTablesId = ?, tableNum = ?, capacity = ? WHERE guestTablesId = ?";
		$statement = $mysqli->prepare($query);
		if($statement === false) {
			throw(new mysqli_sql_exception("unable to prepare statement"));
		}

		// bind the member variables to the place holders in the template
		$wasClean = $statement->bind_param("iii",  $this->guestTablesId, $this->tableNum, $this->capacity, $this->guestTablesId);
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


}

?>