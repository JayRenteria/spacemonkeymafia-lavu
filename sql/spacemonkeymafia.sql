DROP TABLE IF EXISTS reservation;
DROP TABLE IF EXISTS guestTables;

CREATE TABLE reservation (
reservationDate DATETIME,
	reservationTime TIME,
	reservationCount INT UNSIGNED,
	guestName VARCHAR(25),
	numOfGuests INT UNSIGNED,
	phone VARCHAR(9),
	email VARCHAR(64)
);

CREATE TABLE guestTable (
	tableId INT UNSIGNED AUTO_INCREMENT,
	tableNumber INT UNSIGNED,
	capacity INT UNSIGNED,
	PRIMARY KEY (tableId)
);