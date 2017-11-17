-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Person (name, password) VALUES ('savolanen', 'qwerty');
INSERT INTO Person (name, password) VALUES ('martta64', 'salasana');

INSERT INTO Ingredient (name) VALUES ('suklaa');
INSERT INTO Ingredient (name) VALUES ('nakki');

INSERT INTO Category (name) VALUES ('Ruoka');
INSERT INTO Category (name) VALUES ('Juoma');

INSERT INTO Addtable (recipe_id, ingredient_id) VALUES (1,1);

INSERT INTO recipe (category_id, person_id, name, info) VALUES (1, 1, 'resepti', 'kokkaa');

INSERT INTO recipe (category_id, person_id, name, info) VALUES (1, 1, 'nakkikakku', 'kasaa nakkeja kekoon ja nauti ');

INSERT INTO recipe (category_id, person_id, name, info) VALUES (2, 1, 'mehu', 'kaada mehutiiviste lasiin ja lisää vettä. Toivo parasta, että veden ja mehun suhde tuli oikein ja nauti. Tai sitten et.');

INSERT INTO recipe (category_id, person_id, name, info) VALUES (2, 1, 'booli', 'ota litra raakaa mehukattia ja hämmästele, mistä itsesi löydät viikon päästä');

INSERT INTO recipe (category_id, person_id, name, info) VALUES (2, 2, 'maito', 'lypsä lehmä');
