DROP DATABASE IF EXISTS record_store;
CREATE DATABASE record_store;
USE record_store;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
    userID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(userID)
);

DROP TABLE IF EXISTS artists;
CREATE TABLE artists(
    artistID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    country VARCHAR(2),
    foundationYear YEAR,
    logo VARCHAR(255),
    photo VARCHAR(255),
    PRIMARY KEY(artistID)
);

DROP TABLE IF EXISTS labels;
CREATE TABLE labels(
    labelID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    country VARCHAR(2),
    foundationYear YEAR,
    logo VARCHAR(255),
    PRIMARY KEY(labelID)
);

DROP TABLE IF EXISTS records;
CREATE TABLE records(
    recordID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    labelID SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    releaseDate DATE,
    cover VARCHAR(255),
    price FLOAT(5,2),
    PRIMARY KEY(recordID),
    FOREIGN KEY(labelID) REFERENCES labels(labelID)
);

DROP TABLE IF EXISTS tracks;
CREATE TABLE tracks(
    trackID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    artistID SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    duration SMALLINT UNSIGNED,
    PRIMARY KEY(trackID),
    FOREIGN KEY (artistID) REFERENCES artists(artistID)
);

DROP TABLE IF EXISTS genres;
CREATE TABLE genres(
    genreID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY(genreID)
);

DROP TABLE IF EXISTS artistsRecords;
CREATE TABLE artistsRecords(
    artistID SMALLINT UNSIGNED NOT NULL,
    recordID SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (artistID, recordID),
    FOREIGN KEY (artistID) REFERENCES artists(artistID),
    FOREIGN KEY (recordID) REFERENCES records(recordID)
);

DROP TABLE IF EXISTS recordsTracks;
CREATE TABLE recordsTracks(
    recordID SMALLINT UNSIGNED NOT NULL,
    trackID MEDIUMINT UNSIGNED NOT NULL,
    trackNumber TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (recordID, trackID),
    FOREIGN KEY (recordID) REFERENCES records(recordID),
    FOREIGN KEY (trackID) REFERENCES tracks(trackID)
);

DROP TABLE IF EXISTS recordsGenres;
CREATE TABLE recordsGenres(
    recordID SMALLINT UNSIGNED NOT NULL,
    genreID SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (recordID, genreID),
    FOREIGN KEY (recordID) REFERENCES records(recordID),
    FOREIGN KEY (genreID) REFERENCES genres(genreID)
);