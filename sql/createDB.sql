DROP DATABASE IF EXISTS record_store;
CREATE DATABASE record_store;
USE record_store;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
    userId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(userId)
);

DROP TABLE IF EXISTS artists;
CREATE TABLE artists(
    artistId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    country VARCHAR(2),
    foundationYear YEAR,
    logo VARCHAR(255),
    photo VARCHAR(255),
    PRIMARY KEY(artistId)
);

DROP TABLE IF EXISTS labels;
CREATE TABLE labels(
    labelId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    country VARCHAR(2),
    foundationYear YEAR,
    logo VARCHAR(255),
    PRIMARY KEY(labelId)
);

DROP TABLE IF EXISTS genres;
CREATE TABLE genres(
    genreId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY(genreId)
);

DROP TABLE IF EXISTS tracks;
CREATE TABLE tracks(
    trackId MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    artistId SMALLINT UNSIGNED NOT NULL,
    genreId SMALLINT UNSIGNED,
    title VARCHAR(255) NOT NULL,
    duration SMALLINT UNSIGNED,
    PRIMARY KEY(trackId),
    FOREIGN KEY (artistId) REFERENCES artists(artistId),
    FOREIGN KEY (genreId) REFERENCES genres(genreId)
);

DROP TABLE IF EXISTS records;
CREATE TABLE records(
    recordId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    labelId SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    releaseDate DATE,
    cover VARCHAR(255),
    price FLOAT(5,2),
    PRIMARY KEY(recordId),
    FOREIGN KEY(labelId) REFERENCES labels(labelId)
);

DROP TABLE IF EXISTS artistsRecords;
CREATE TABLE artistsRecords(
    artistId SMALLINT UNSIGNED NOT NULL,
    recordId SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (artistId, recordId),
    FOREIGN KEY (artistId) REFERENCES artists(artistId),
    FOREIGN KEY (recordId) REFERENCES records(recordId)
);

DROP TABLE IF EXISTS recordsTracks;
CREATE TABLE recordsTracks(
    recordId SMALLINT UNSIGNED NOT NULL,
    trackId MEDIUMINT UNSIGNED NOT NULL,
    trackNumber TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (recordId, trackId),
    FOREIGN KEY (recordId) REFERENCES records(recordId),
    FOREIGN KEY (trackId) REFERENCES tracks(trackId)
);