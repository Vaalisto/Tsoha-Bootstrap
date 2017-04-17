-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Game (gamename, published_year, publisher, description, added) VALUES ('Monopoli', 1950, 'Monopoli-ukko', 'CAPITALISM HO!', NOW());
INSERT INTO Game (gamename, published_year, publisher, description, added) VALUES ('Scythe', 2016, 'Stonemaier Games', 'Hassu satusota', NOW());
INSERT INTO Game (gamename, published_year, publisher, description, added) VALUES ('Space Alert', 2008, 'Rio Grande Games', 'Hektinen scifi-aiheinen yhteistyöpeli', NOW());
INSERT INTO Account (accountname, password, is_admin) VALUES ('Ville', 'salainensana', TRUE);
INSERT INTO Account (accountname, password) VALUES ('Kalle', 'huonosana');
INSERT INTO Rating (rate, account_id, game_id) VALUES (8, 1, 2);
INSERT INTO Genre (genrename, description) VALUES ('Kauhu', 'Alkukaintainen tunne');
INSERT INTO Genre (genrename, description) VALUES ('Kilpailullinen', 'Kilpailullisissa peleissä on suuri osuus pelaajien välisellä paremmuudella.');
INSERT INTO Genre (genrename, description) VALUES ('Yhteistyö', 'Yhteistyöpeleissä pelaajat pelaavat yleensä pelisääntöjen tarjoamaa mekaniikkaa vastaan.');
INSERT INTO Genre (genrename, description) VALUES ('Fantasia', 'Miekkaa ja magiaa.');
INSERT INTO Genre (genrename, description) VALUES ('Scifi', 'Tulevaisuuden visioita tieteen ja tekniikan vaikutuksista ihmiskuntaan.');
INSERT INTO Gamegenre (game_id, genre_id) VALUES (3, 5);