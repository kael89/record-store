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
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
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
    bio MEDIUMTEXT,
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(artistId)
);

DROP TABLE IF EXISTS genres;
CREATE TABLE genres(
    genreId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(genreId)
);

DROP TABLE IF EXISTS records;
CREATE TABLE records(
    recordId SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    genreId SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    releaseDate DATE,
    cover VARCHAR(255),
    price FLOAT(5,2),
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(recordId),
    FOREIGN KEY (genreId) REFERENCES genres(genreId)
);

DROP TABLE IF EXISTS tracks;
CREATE TABLE tracks(
    trackId MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    artistId SMALLINT UNSIGNED NOT NULL,
    recordId SMALLINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    position TINYINT UNSIGNED NOT NULL,
    duration SMALLINT UNSIGNED,
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(trackId),
    FOREIGN KEY (artistId) REFERENCES artists(artistId),
    FOREIGN KEY (recordId) REFERENCES records(recordId)
);