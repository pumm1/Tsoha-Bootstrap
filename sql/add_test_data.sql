-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Person (name, password) VALUES ('savolanen', 'qwerty');
INSERT INTO Person (name, password) VALUES ('martta64', 'salasana');

INSERT INTO Ingredient (name) VALUES ('suklaa');
INSERT INTO Ingredient (name) VALUES ('nakki');

INSERT INTO Category (name) VALUES ('Ruoka');
INSERT INTO Category (name) VALUES ('Juoma');

INSERT INTO Addtable (recipe_id, ingredient_id) VALUES (1,1);

INSERT INTO recipe (category_id, person_id, name, info) VALUES (1, 1, 'resepti', 'kokkaa');


