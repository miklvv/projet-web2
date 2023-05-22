CREATE TABLE login (
	"idUser"	INTEGER NOT NULL UNIQUE,
	"mail"	TEXT NOT NULL,
	"login"	TEXT NOT NULL,
	"password"	TEXT NOT NULL,
	PRIMARY KEY("idUser" AUTOINCREMENT)
);

INSERT INTO login (mail, login, password) VALUES ('test@test.fr', 'Test@_', 'lannion') ;