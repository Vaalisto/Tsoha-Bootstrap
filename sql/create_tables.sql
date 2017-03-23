-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Game(
	id SERIAL PRIMARY KEY,
	gamename varchar(120) NOT NULL,
	published_year INTEGER NOT NULL,
	publisher varchar(120),
	description varchar(500),
	added DATE
);

CREATE TABLE Account(
	id SERIAL PRIMARY KEY,
	accountname varchar(30) NOT NULL,
	password varchar(120) NOT NULL,
	is_admin boolean DEFAULT FALSE	
);

CREATE TABLE Rating(
	id SERIAL PRIMARY KEY,
	rate INTEGER NOT NULL,
	account_id INTEGER REFERENCES Account(id),
	game_id INTEGER REFERENCES Game(id)
);

CREATE TABLE Genre(
	id SERIAL PRIMARY KEY,
	genrename varchar(30) NOT NULL,
	description varchar(500) NOT NULL
);

CREATE TABLE Gamegenre(
	game_id INTEGER REFERENCES Game(id) ON DELETE CASCADE,
	genre_id INTEGER REFERENCES Genre(id) ON DELETE CASCADE,
	PRIMARY KEY (game_id, genre_id)
);
