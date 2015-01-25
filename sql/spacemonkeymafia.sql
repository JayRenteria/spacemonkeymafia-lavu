DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS guestTables;

CREATE TABLE reservation (
reservationDate DATETIME,
	reservationTime TIME,
	reservationCount INT UNSIGNED,
	guestName VARCHAR(25),
	numOfGuests INT UNSIGNED
);

CREATE TABLE guestTables (
	tableId INT UNSIGNED AUTO_INCREMENT,
	tableNumber INT UNSIGNED,
	capacity INT UNSIGNED,
	PRIMARY KEY (tableId)
);