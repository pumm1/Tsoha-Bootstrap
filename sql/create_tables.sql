-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Person(
	id SERIAL PRIMARY KEY,
	name varchar(10) NOT NULL,
	password varchar(20) NOT NULL
);

CREATE TABLE Category(
	id SERIAL PRIMARY KEY,	
	name varchar(40) NOT NULL
);

CREATE TABLE Ingredient(
	id SERIAL PRIMARY KEY,
	name varchar(40) NOT NULL
);

CREATE TABLE Recipe(
	id SERIAL PRIMARY KEY,
	category_id INTEGER REFERENCES Category(id),
	person_id INTEGER REFERENCES Person(id),
	name varchar(40) NOT NULL,
	info varchar(500) NOT NULL
);

CREATE TABLE Addtable(
	recipe_id INTEGER REFERENCES Recipe(id),
	ingredient_id INTEGER REFERENCES Ingredient(id)
);

