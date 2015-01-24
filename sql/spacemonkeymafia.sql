DROP TABLE IF EXISTS reservation;

CREATE TABLE reservation (
reservationDateTime DATETIME,
	reservationCount INT UNSIGNED,
	guestName VARCHAR(25),
	numOfGuests INT UNSIGNED
);