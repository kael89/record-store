USE record_store;


##users(userId,firstName,lastName,email,password,admin)
DELETE FROM users;
INSERT INTO users VALUES(1,'Kostas','Karvounis','kos.karvounis.zoumpos@gmail.com','11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1',TRUE);
INSERT INTO users VALUES(2,'Kostas','Karvounis','kael1989@gmail.com','11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1',TRUE);
#INSERT INTO users VALUES(3,'Elena','Kyriaki','elena.kyriaki@gmail.com','2E8F5D4AA19B860AEB84E2A6C45713D81F009FD2E691356B17FF76FBABDF47B2',FALSE);
#INSERT INTO users VALUES(4,'Alexis','Karvounis','al3xkarv@gmail.com','EC03ACE04805C0B06CE7A3E7D6882B9311714CC03C342EA60B6A30A411994313',FALSE);


##artists(artistId, name, country, foundationDate, logo, photo)
DELETE FROM artists;
INSERT INTO artists VALUES(1, 'Metallica', 'US', 1981, NULL, NULL);
INSERT INTO artists VALUES(2, 'Iron Maiden', 'GB', 1975, NULL, NULL);
INSERT INTO artists VALUES(3, 'Black Sabbath', 'GB', 1968, NULL, NULL);
INSERT INTO artists VALUES(4, 'Judas Priest', 'GB', 1969, NULL, NULL);
INSERT INTO artists VALUES(5, 'Sepultura', 'BR', 1984, NULL, NULL);


##labels(labelId, name, country, foundationYear, logo)
DELETE FROM labels;
INSERT INTO labels VALUES(1, 'Megaforce', 'US', 1982, NULL);
INSERT INTO labels VALUES(2, 'EMI', 'UK', 1931, NULL);
INSERT INTO labels VALUES(3, 'Vertigo', 'UK', 1969, NULL);
INSERT INTO labels VALUES(4, 'Gull', 'UK', 1974, NULL);
INSERT INTO labels VALUES(5, 'Roadrunner', 'NL', 1980, NULL);
INSERT INTO labels VALUES(6, 'Columbia', 'US', 1987, NULL);


##genres(genreId, name)
DELETE FROM genres;
INSERT INTO genres VALUES(1, 'Heavy Metal');
INSERT INTO genres VALUES(2, 'Thrash Metal');
INSERT INTO genres VALUES(3, 'Groove Metal');
INSERT INTO genres VALUES(4, 'Nu Metal');


##records(recordId, labelId, title, releaseDate, cover, price)
DELETE FROM records;
INSERT INTO records VALUES(1, 1, 'Kill ''em All', '1983-07-25', 'kill_em_all.jpg', 09.99);
INSERT INTO records VALUES(2, 1, 'Ride The Lightning', '1984-07-27', 'ride_the_lightning.jpg', 09.75);
INSERT INTO records VALUES(3, 2, 'The Number of the Beast', '1982-03-22', 'the_number_of_the_beast.jpg', 12.15);
INSERT INTO records VALUES(4, 3, 'Black Sabbath', '1970-02-13', NULL, 08.99);
INSERT INTO records VALUES(5, 3, 'ParanoId', '1970-09-18', NULL, 08.99);
INSERT INTO records VALUES(6, 4, 'Sad Wings of Destiny', '1976-03-23', NULL, 07.50);
INSERT INTO records VALUES(7, 6, 'British Steel', '1980-04-14', NULL, 08.99);
INSERT INTO records VALUES(8, 6, 'Painkiller', '1990-09-03', NULL, 12.10);
INSERT INTO records VALUES(9, 5, 'Roots', '1996-02-20', NULL, 11.70);
INSERT INTO records VALUES(10, 5, 'Chaos A.D.', '1993-10-19', NULL, 11.30);


##tracks(trackId, artistId, title, duration)
DELETE FROM tracks;
#Metallica - Kill 'em All (10 tracks)
INSERT INTO tracks VALUES(1, 1, 2, 'Hit the Lights', 256);
INSERT INTO tracks VALUES(2, 1, 2, 'The Four Horsemen', 433);
INSERT INTO tracks VALUES(3, 1, 2, 'Motorbreath', 188);
INSERT INTO tracks VALUES(4, 1, 2, 'Jump in the Fire', 281);
INSERT INTO tracks VALUES(5, 1, 2, '(Anesthesia) - Pulling Teeth', 255);
INSERT INTO tracks VALUES(6, 1, 2, 'Whiplash', 250);
INSERT INTO tracks VALUES(7, 1, 2, 'Phantom Lord', 302);
INSERT INTO tracks VALUES(8, 1, 2, 'No Remorse', 386);
INSERT INTO tracks VALUES(9, 1, 2, 'Seek & Destroy', 415);
INSERT INTO tracks VALUES(10, 1, 2, 'Metal Militia', 309);
#Metallica - RIde the Lightning (8 tracks)
INSERT INTO tracks VALUES(11, 1, 2, 'Fight Fire with Fire', 285);
INSERT INTO tracks VALUES(12, 1, 2, 'Ride the Lightning', 396);
INSERT INTO tracks VALUES(13, 1, 2, 'For Whom the Bell Tolls', 309);
INSERT INTO tracks VALUES(14, 1, 2, 'Fade to Black', 417);
INSERT INTO tracks VALUES(15, 1, 2, 'Trapped Under Ice', 244);
INSERT INTO tracks VALUES(16, 1, 2, 'Escape', 263);
INSERT INTO tracks VALUES(17, 1, 2, 'Creeping Death', 396);
INSERT INTO tracks VALUES(18, 1, 2, 'The Call of Ktulu', 523);
#Iron MaIden - The Number of the Beast (9 tracks)
INSERT INTO tracks VALUES(19, 2, 1, 'Invaders', NULL);
INSERT INTO tracks VALUES(20, 2, 1, 'Children of the Damned', NULL);
INSERT INTO tracks VALUES(21, 2, 1, 'The Prisoner', NULL);
INSERT INTO tracks VALUES(22, 2, 1, '22 Acacia Avenue', NULL);
INSERT INTO tracks VALUES(23, 2, 1, 'The Number of the Beast', NULL);
INSERT INTO tracks VALUES(24, 2, 1, 'Run to the Hills', NULL);
INSERT INTO tracks VALUES(25, 2, 1, 'Gangland', NULL);
INSERT INTO tracks VALUES(26, 2, 1, 'Hallowed Be Thy Name', NULL);


##recordsTracks(recordId, trackId, trackNumber)
DELETE FROM recordsTracks;
#Metallica - Kill 'em All (10 tracks)
INSERT INTO recordsTracks VALUES(1, 1, 1);
INSERT INTO recordsTracks VALUES(1, 2, 2);
INSERT INTO recordsTracks VALUES(1, 3, 3);
INSERT INTO recordsTracks VALUES(1, 4, 4);
INSERT INTO recordsTracks VALUES(1, 5, 5);
INSERT INTO recordsTracks VALUES(1, 6, 6);
INSERT INTO recordsTracks VALUES(1, 7, 7);
INSERT INTO recordsTracks VALUES(1, 8, 8);
INSERT INTO recordsTracks VALUES(1, 9, 9);
INSERT INTO recordsTracks VALUES(1, 10, 10);
#Metallica - RIde the Lightning (8 tracks)
INSERT INTO recordsTracks VALUES(2, 11, 1);
INSERT INTO recordsTracks VALUES(2, 12, 2);
INSERT INTO recordsTracks VALUES(2, 13, 3);
INSERT INTO recordsTracks VALUES(2, 14, 4);
INSERT INTO recordsTracks VALUES(2, 15, 5);
INSERT INTO recordsTracks VALUES(2, 16, 6);
INSERT INTO recordsTracks VALUES(2, 17, 7);
INSERT INTO recordsTracks VALUES(2, 18, 8);
#Iron MaIden - The Number of the Beast (9 tracks)
INSERT INTO recordsTracks VALUES(3, 19, 1);
INSERT INTO recordsTracks VALUES(3, 20, 2);
INSERT INTO recordsTracks VALUES(3, 21, 3);
INSERT INTO recordsTracks VALUES(3, 22, 4);
INSERT INTO recordsTracks VALUES(3, 23, 5);
INSERT INTO recordsTracks VALUES(3, 24, 6);
INSERT INTO recordsTracks VALUES(3, 25, 7);
INSERT INTO recordsTracks VALUES(3, 26, 8);