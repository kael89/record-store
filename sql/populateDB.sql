USE record_store;


##users(userId,firstName,lastName,email,password,admin)
DELETE FROM users;
INSERT INTO users VALUES(1, 'Admin', 'Admin', 'admin@recordstore.com', '11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1', TRUE, FALSE);


##artists(artistId, name, country, foundationDate, logo, photo, deleted)
DELETE FROM artists;
INSERT INTO artists VALUES(1, 'Metallica', 'US', 1981, '1.png', '1.jpg', '<p>Metallica is an American heavy metal band from Los Angeles, California. The band was formed in 1981 by drummer Lars Ulrich and vocalist/guitarist James Hetfield. The band''s fast tempos, instrumentals and aggressive musicianship made them one of the founding "big four" bands of thrash metal, alongside Megadeth, Anthrax and Slayer. Metallica''s current lineup comprises founding members Hetfield and Ulrich, longtime lead guitarist Kirk Hammett and bassist Robert Trujillo. Guitarist Dave Mustaine (who formed Megadeth) and bassists Ron McGovney, Cliff Burton and Jason Newsted are former members of the band.</p>Metallica earned a growing fan base in the underground music community and won critical acclaim with its first five albums. The band''s third album, Master of Puppets (1986), was described as one of the heaviest and most influential thrash metal albums, and its eponymous fifth album, Metallica (1991), appealed to a more mainstream audience, achieving substantial commercial success and selling over 16 million copies in the United States to date, making it the best-selling album of the SoundScan era. In 2000, Metallica joined with other artists who filed a lawsuit against Napster for sharing the band''s copyright-protected material without consent; a settlement was reached and Napster became a pay-to-use service. In 2009, Metallica was inducted into the Rock and Roll Hall of Fame.</p>', FALSE);
INSERT INTO artists VALUES(2, 'Iron Maiden', 'GB', 1975, '2.png', '2.jpg', '<p>Iron Maiden are an English heavy metal band formed in Leyton, East London, in 1975 by bassist and primary songwriter Steve Harris. The band''s discography has grown to thirty-eight albums, including sixteen studio albums, eleven live albums, four EPs, and seven compilations.</p>Pioneers of the new wave of British heavy metal, Iron Maiden achieved initial success during the early 1980s. After several line-up changes, the band went on to release a series of UK and US platinum and gold albums, including 1982''s The Number of the Beast, 1983''s Piece of Mind, 1984''s Powerslave, 1985''s live release Live After Death, 1986''s Somewhere in Time and 1988''s Seventh Son of a Seventh Son. Since the return of lead vocalist Bruce Dickinson and guitarist Adrian Smith in 1999, the band have undergone a resurgence in popularity, with their 2010 studio offering, The Final Frontier, peaking at No. 1 in 28 countries and receiving widespread critical acclaim. Their sixteenth studio album, The Book of Souls, was released on 4 September 2015 to similar success.</p>', FALSE);
INSERT INTO artists VALUES(3, 'Black Sabbath', 'GB', 1968, '3.png', '3.jpg', '<p>Black Sabbath were an English rock band, formed in Birmingham in 1968, by guitarist and main songwriter Tony Iommi, bassist and main lyricist Geezer Butler, singer Ozzy Osbourne, and drummer Bill Ward. Black Sabbath are often cited as pioneers of heavy metal music. The band helped define the genre with releases such as Black Sabbath (1970), Paranoid (1970) and Master of Reality (1971). The band had multiple line-up changes, with Iommi being the only constant member throughout its history.</p>Formed in 1968 as the Polka Tulk Blues Band, a blues rock band, the group went through line up changes, renamed themselves as Earth, broke up and reformed. By 1969, they had named themselves Black Sabbath after the film Black Sabbath starring Boris Karloff, and began incorporating occult themes with horror-inspired lyrics and tuned-down guitars. The band''s first show as Black Sabbath took place on 30 August 1969, in Workington. Signing to Philips Records in November 1969, they released their first single, "Evil Woman" in January 1970. Their debut album, Black Sabbath, was released on Friday the 13th, February 1970, on Philips'' newly formed progressive rock label, Vertigo Records. Though receiving a negative critical response, the album was a commercial success and reached number 8 in the UK Albums Chart, so the band returned to the studios to quickly record the follow up, Paranoid, which was also released in 1970.</p>', FALSE);
INSERT INTO artists VALUES(4, 'Judas Priest', 'GB', 1969, '4.png', '4.jpg', '<p>Judas Priest are an English heavy metal band formed in Birmingham, England, in 1969. The band have sold close to 50 million albums to date. They are frequently ranked as one of the greatest metal bands of all time.[citation needed] Despite an innovative and pioneering body of work in the latter half of the 1970s, the band struggled with indifferent record production, repeated changes of drummer and lack of major commercial success or attention until 1980, when they adopted a more simplified sound on the album British Steel, which helped shoot them to rock superstar status. </p>The band''s membership has seen much turnover, including a revolving cast of drummers in the 1970s, and the temporary departure of singer Rob Halford in the early 1990s. The current line-up consists of Halford, guitarists Glenn Tipton and Richie Faulkner, bassist Ian Hill, and drummer Scott Travis. The band''s best-selling album is 1982''s Screaming for Vengeance with their most commercially successful line-up, featuring Halford, Tipton, Hill, guitarist K. K. Downing, and drummer Dave Holland. Tipton and Hill are the only two members of the band to appear on every album.</p>', FALSE);
INSERT INTO artists VALUES(5, 'Sepultura', 'BR', 1984, '5.png', '5.jpg', '<p>Sepultura is a Brazilian heavy metal band from Belo Horizonte. Formed in 1984 by brothers Max and Igor Cavalera, the band was a major force in the thrash metal and groove metal genres during the late 1980s and early 1990s, with their later experiments drawing influence from alternative metal, world music, nu metal, hardcore punk and industrial metal.</p>Sepultura has had several changes in its lineup since its formation, with Max and Igor Cavalera departing in 1996 and 2006, respectively. Sepultura''s current lineup consists of vocalist Derrick Green, guitarist Andreas Kisser, bassist Paulo Jr. and drummer Eloy Casagrande. Since Igor Cavalera''s departure in 2006, there have been no original members left in the band. Paulo Jr., who has been a member of Sepultura since 1985, is the only member to appear on every release. Kisser, who replaced Jairo Guedz in 1987, has played on all of the band''s studio albums, except for their debut Morbid Visions (1986) and the split Bestial Devastation (1985).</p>', FALSE);


##genres(genreId, name, deleted)
DELETE FROM genres;
INSERT INTO genres VALUES(1, 'Other', FALSE);
INSERT INTO genres VALUES(2, 'Alternative Metal', FALSE);
INSERT INTO genres VALUES(3, 'Black Metal', FALSE);
INSERT INTO genres VALUES(4, 'Deathcore', FALSE);
INSERT INTO genres VALUES(5, 'Death Metal', FALSE);
INSERT INTO genres VALUES(6, 'Djent', FALSE);
INSERT INTO genres VALUES(7, 'Doom Metal', FALSE);
INSERT INTO genres VALUES(8, 'Epic Metal', FALSE);
INSERT INTO genres VALUES(9, 'Grindcore', FALSE);
INSERT INTO genres VALUES(10, 'Groove Metal', FALSE);
INSERT INTO genres VALUES(11, 'Hardcore', FALSE);
INSERT INTO genres VALUES(12, 'Heavy Metal', FALSE);
INSERT INTO genres VALUES(13, 'Industrial Metal', FALSE);
INSERT INTO genres VALUES(14, 'Melodic Metal', FALSE);
INSERT INTO genres VALUES(15, 'Metalcore', FALSE);
INSERT INTO genres VALUES(16, 'Power Metal', FALSE);
INSERT INTO genres VALUES(17, 'Progressive Metal', FALSE);
INSERT INTO genres VALUES(18, 'Rapcore', FALSE);
INSERT INTO genres VALUES(19, 'Speed Metal', FALSE);
INSERT INTO genres VALUES(20, 'Stoner Metal', FALSE);
INSERT INTO genres VALUES(21, 'Symphonic Metal', FALSE);
INSERT INTO genres VALUES(22, 'Thrash Metal', FALSE);
INSERT INTO genres VALUES(23, 'Viking Metal', FALSE);


##records(recordId, genreId, title, releaseDate, cover, price, deleted)
DELETE FROM records;
INSERT INTO records VALUES(1, 22, 'Kill ''em All', '1983-07-25', '1.jpg', 09.99, FALSE);
INSERT INTO records VALUES(2, 22, 'Ride the Lightning', '1984-07-27', '2.jpg', 09.75, FALSE);
INSERT INTO records VALUES(3, 12, 'The Number of the Beast', '1982-03-22', '3.jpg', 12.15, FALSE);
INSERT INTO records VALUES(4, 12, 'Black Sabbath', '1970-02-13', '4.jpg', 08.99, FALSE);
INSERT INTO records VALUES(5, 12, 'Paranoid', '1970-09-18', '5.jpg', 08.99, FALSE);
INSERT INTO records VALUES(6, 12, 'Sad Wings of Destiny', '1976-03-23', '6.jpg', 07.50, FALSE);
INSERT INTO records VALUES(7, 12, 'British Steel', '1980-04-14', '7.jpg', 08.99, FALSE);
INSERT INTO records VALUES(8, 12, 'Painkiller', '1990-09-03', '8.jpg', 12.10, FALSE);
INSERT INTO records VALUES(9, 22, 'Chaos A.D.', '1993-10-19', '10.jpg', 11.30, FALSE);
INSERT INTO records VALUES(10, 10, 'Roots', '1996-02-20', '9.jpg', 11.70, FALSE);


##tracks(trackId, artistId, recordId, title, position, duration, deleted)
DELETE FROM tracks;
#Metallica - Kill 'em All (10 tracks)
INSERT INTO tracks VALUES(1, 1, 1, 'Hit the Lights', 1, 433, FALSE);
INSERT INTO tracks VALUES(2, 1, 1, 'The Four Horsemen', 2, 256, FALSE);
INSERT INTO tracks VALUES(3, 1, 1, 'Motorbreath', 3, 188, FALSE);
INSERT INTO tracks VALUES(4, 1, 1, 'Jump in the Fire', 4, 281, FALSE);
INSERT INTO tracks VALUES(5, 1, 1, '(Anesthesia) - Pulling Teeth', 5, 255, FALSE);
INSERT INTO tracks VALUES(6, 1, 1, 'Whiplash', 6, 250, FALSE);
INSERT INTO tracks VALUES(7, 1, 1, 'Phantom Lord', 7, 302, FALSE);
INSERT INTO tracks VALUES(8, 1, 1, 'No Remorse', 8, 386, FALSE);
INSERT INTO tracks VALUES(9, 1, 1, 'Seek & Destroy', 9, 415, FALSE);
INSERT INTO tracks VALUES(10, 1, 1, 'Metal Militia', 10, 309, FALSE);
#Metallica - RIde the Lightning (8 tracks)
INSERT INTO tracks VALUES(11, 1, 2, 'Fight Fire with Fire', 1, 285, FALSE);
INSERT INTO tracks VALUES(12, 1, 2, 'Ride the Lightning', 2, 396, FALSE);
INSERT INTO tracks VALUES(13, 1, 2, 'For Whom the Bell Tolls', 3, 309, FALSE);
INSERT INTO tracks VALUES(14, 1, 2, 'Fade to Black', 4, 417, FALSE);
INSERT INTO tracks VALUES(15, 1, 2, 'Trapped Under Ice', 5, 244, FALSE);
INSERT INTO tracks VALUES(16, 1, 2, 'Escape', 6, 263, FALSE);
INSERT INTO tracks VALUES(17, 1, 2, 'Creeping Death', 7, 396, FALSE);
INSERT INTO tracks VALUES(18, 1, 2, 'The Call of Ktulu', 8, 523, FALSE);
#Iron MaIden - The Number of the Beast (9 tracks)
INSERT INTO tracks VALUES(19, 2, 3, 'Invaders', 1, 200, FALSE);
INSERT INTO tracks VALUES(20, 2, 3, 'Children of the Damned', 2, 274, FALSE);
INSERT INTO tracks VALUES(21, 2, 3, 'The Prisoner', 3, 334, FALSE);
INSERT INTO tracks VALUES(22, 2, 3, '22 Acacia Avenue', 4, 394, FALSE);
INSERT INTO tracks VALUES(23, 2, 3, 'The Number of the Beast', 5, 265, FALSE);
INSERT INTO tracks VALUES(24, 2, 3, 'Run to the Hills', 6, 230, FALSE);
INSERT INTO tracks VALUES(25, 2, 3, 'Gangland', 7, 226, FALSE);
INSERT INTO tracks VALUES(26, 2, 3, 'Hallowed Be Thy Name', 8, 428, FALSE);
#Black Sabbath - Black Sabbath (7 tracks)
INSERT INTO tracks VALUES(27, 3, 4, 'Black Sabbath', 1, 380, FALSE);
INSERT INTO tracks VALUES(28, 3, 4, 'The Wizard', 2, 264, FALSE);
INSERT INTO tracks VALUES(29, 3, 4, 'Behind the Wall of Sleep', 3, 217, FALSE);
INSERT INTO tracks VALUES(30, 3, 4, 'N.I.B.', 4, 368, FALSE);
INSERT INTO tracks VALUES(31, 3, 4, 'Evil Woman', 5, 205, FALSE);
INSERT INTO tracks VALUES(32, 3, 4, 'Sleeping Village', 6, 226, FALSE);
INSERT INTO tracks VALUES(33, 3, 4, 'Warning', 7, 628, FALSE);
#Black Sabbath - Paranoid (8 tracks)
INSERT INTO tracks VALUES(34, 3, 5, 'War Pigs', 1, 477, FALSE);
INSERT INTO tracks VALUES(35, 3, 5, 'Paranoid', 2, 168, FALSE);
INSERT INTO tracks VALUES(36, 3, 5, 'Planet Caravan', 3, 272, FALSE);
INSERT INTO tracks VALUES(37, 3, 5, 'Iron Man', 4, 356, FALSE);
INSERT INTO tracks VALUES(38, 3, 5, 'Electric Funeral', 5, 293, FALSE);
INSERT INTO tracks VALUES(39, 3, 5, 'Hand of Doom', 6, 428, FALSE);
INSERT INTO tracks VALUES(40, 3, 5, 'Rat Salad', 7, 150, FALSE);
INSERT INTO tracks VALUES(41, 3, 5, 'Fairies Wear Boots', 8, 255, FALSE);
#Judas Priest - Sad Wings of Destiny (8 tracks)
INSERT INTO tracks VALUES(42, 4, 6, 'Victim of Changes', 1, 467, FALSE);
INSERT INTO tracks VALUES(43, 4, 6, 'The Ripper', 2, 170, FALSE);
INSERT INTO tracks VALUES(44, 4, 6, 'Dreamer Deceiver', 3, 351, FALSE);
INSERT INTO tracks VALUES(45, 4, 6, 'Deceiver', 4, 160, FALSE);
INSERT INTO tracks VALUES(46, 4, 6, 'Prelude', 5, 122, FALSE);
INSERT INTO tracks VALUES(47, 4, 6, 'Tyrant', 6, 268, FALSE);
INSERT INTO tracks VALUES(48, 4, 6, 'Genocide', 7, 351, FALSE);
INSERT INTO tracks VALUES(49, 4, 6, 'Epitaph', 8, 188, FALSE);
INSERT INTO tracks VALUES(50, 4, 6, 'Island of Domincation', 9, 272, FALSE);
#Judas Priest - British Steel (9 tracks)
INSERT INTO tracks VALUES(51, 4, 7, 'Rapid Fire', 1, 248, FALSE);
INSERT INTO tracks VALUES(52, 4, 7, 'Metal Gods', 2, 240, FALSE);
INSERT INTO tracks VALUES(53, 4, 7, 'Breaking the Law', 3, 155, FALSE);
INSERT INTO tracks VALUES(54, 4, 7, 'Grinder', 4, 238, FALSE);
INSERT INTO tracks VALUES(55, 4, 7, 'United', 5, 215, FALSE);
INSERT INTO tracks VALUES(56, 4, 7, 'You Don''t Have to Be Old to Be Wise' , 6, 304, FALSE);
INSERT INTO tracks VALUES(57, 4, 7, 'Living After Midnight', 7, 211, FALSE);
INSERT INTO tracks VALUES(58, 4, 7, 'The Rage', 8, 284, FALSE);
INSERT INTO tracks VALUES(59, 4, 7, 'Steeler', 9, 270, FALSE);
#Judas Priest - Painkiller (10 tracks)
INSERT INTO tracks VALUES(60, 4, 8, 'Painkiller', 1, 366, FALSE);
INSERT INTO tracks VALUES(61, 4, 8, 'Hell Patrol', 2, 215, FALSE);
INSERT INTO tracks VALUES(62, 4, 8, 'All Guns Blazing', 3, 236, FALSE);
INSERT INTO tracks VALUES(63, 4, 8, 'Leather Rebel', 4, 214, FALSE);
INSERT INTO tracks VALUES(64, 4, 8, 'Metal Meltdown', 5, 286, FALSE);
INSERT INTO tracks VALUES(65, 4, 8, 'Night Crawler', 6, 344, FALSE);
INSERT INTO tracks VALUES(66, 4, 8, 'Between the Hammer & The Anvil', 7, 287, FALSE);
INSERT INTO tracks VALUES(67, 4, 8, 'A Touch of Evil', 8, 342, FALSE);
INSERT INTO tracks VALUES(68, 4, 8, 'Battle Hymn', 9, 56, FALSE);
INSERT INTO tracks VALUES(70, 4, 8, 'One Shot at Glory', 10, 406, FALSE);
#Sepultura - Chaos A.D. (12 tracks)
INSERT INTO tracks VALUES(71, 5, 9, 'Refuse/Resist', 1, 200, FALSE);
INSERT INTO tracks VALUES(72, 5, 9, 'Territory', 2, 267, FALSE);
INSERT INTO tracks VALUES(73, 5, 9, 'Slave New World', 3, 175, FALSE);
INSERT INTO tracks VALUES(74, 5, 9, 'Amen', 4, 267, FALSE);
INSERT INTO tracks VALUES(75, 5, 9, 'Kaiowas', 5, 223, FALSE);
INSERT INTO tracks VALUES(76, 5, 9, 'Propaganda', 6, 213, FALSE);
INSERT INTO tracks VALUES(77, 5, 9, 'Biotech is Godzilla', 7, 112, FALSE);
INSERT INTO tracks VALUES(78, 5, 9, 'Nomad', 8, 299, FALSE);
INSERT INTO tracks VALUES(79, 5, 9, 'We Who Are Not as Others', 9, 222, FALSE);
INSERT INTO tracks VALUES(80, 5, 9, 'Manifest', 10, 289, FALSE);
INSERT INTO tracks VALUES(81, 5, 9, 'The Hunt', 11, 239, FALSE);
INSERT INTO tracks VALUES(82, 5, 9, 'Clenched Fist', 12, 298, FALSE);
#Sepultura - Roots (15 tracks)
INSERT INTO tracks VALUES(83, 5, 10, 'Roots Bloody Roots', 1, 212, FALSE);
INSERT INTO tracks VALUES(84, 5, 10, 'Attitude', 2, 255, FALSE);
INSERT INTO tracks VALUES(85, 5, 10, 'Cut-Throat', 3, 164, FALSE);
INSERT INTO tracks VALUES(86, 5, 10, 'Ratamahatta', 4, 270, FALSE);
INSERT INTO tracks VALUES(87, 5, 10, 'Breed Apart', 5, 241, FALSE);
INSERT INTO tracks VALUES(88, 5, 10, 'Straighthate', 6, 221, FALSE);
INSERT INTO tracks VALUES(89, 5, 10, 'Spit', 7, 165, FALSE);
INSERT INTO tracks VALUES(90, 5, 10, 'Lookaway', 8, 326, FALSE);
INSERT INTO tracks VALUES(91, 5, 10, 'Dusted', 9, 243, FALSE);
INSERT INTO tracks VALUES(92, 5, 10, 'Born Stubborn', 10, 247, FALSE);
INSERT INTO tracks VALUES(93, 5, 10, 'Jasco', 11, 117, FALSE);
INSERT INTO tracks VALUES(94, 5, 10, 'Itsari', 12, 288, FALSE);
INSERT INTO tracks VALUES(95, 5, 10, 'Ambush', 13, 279, FALSE);
INSERT INTO tracks VALUES(96, 5, 10, 'Endangered Species', 14, 319, FALSE);
INSERT INTO tracks VALUES(97, 5, 10, 'Dictatorship', 15, 86, FALSE);