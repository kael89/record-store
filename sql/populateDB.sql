USE record_store;


##users(userId,firstName,lastName,email,password,admin)
DELETE FROM users;
INSERT INTO users VALUES(1, 'Kostas', 'Karvounis', 'kos.karvounis.zoumpos@gmail.com', '11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1', TRUE, FALSE);
INSERT INTO users VALUES(2, 'Kostas', 'Karvounis', 'kael1989@gmail.com', '11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1', TRUE, FALSE);
#INSERT INTO users VALUES(3,'Elena','Kyriaki','elena.kyriaki@gmail.com','2E8F5D4AA19B860AEB84E2A6C45713D81F009FD2E691356B17FF76FBABDF47B2',FALSE);
#INSERT INTO users VALUES(4,'Alexis','Karvounis','al3xkarv@gmail.com','EC03ACE04805C0B06CE7A3E7D6882B9311714CC03C342EA60B6A30A411994313',FALSE);


##artists(artistId, name, country, foundationDate, logo, photo, deleted)
DELETE FROM artists;
INSERT INTO artists VALUES(1, 'Metallica', 'US', 1981, '1.png', '1.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sagittis massa sed augue pretium, eget fermentum ipsum lobortis. Sed commodo justo risus. Fusce elementum quam in elementum ultrices. Morbi a ullamcorper enim. Etiam ut vehicula nulla. Praesent aliquet enim lacus, quis consectetur erat tincidunt sit amet. Nunc placerat leo in enim fringilla pretium. Sed ac mi ex. Fusce leo lectus, rhoncus quis malesuada ut, blandit eu massa. Quisque facilisis tincidunt pulvinar. Donec molestie purus vitae egestas auctor. Nam feugiat nulla metus, sed vestibulum sapien scelerisque sed. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla aliquet dui id odio tristique, eu maximus leo mattis. Duis rutrum, massa at gravida tincidunt, quam nisl faucibus velit, sit amet sollicitudin velit nibh vitae dolor.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt interdum erat, id rutrum quam interdum eu. Mauris sodales felis eget efficitur mattis. Pellentesque tempus gravida enim a ultricies. Pellentesque vitae ultrices augue, non efficitur neque. Donec ac mattis tortor, sed volutpat mauris. Duis ultricies iaculis nisi eget pretium. Aliquam ornare sed libero sit amet iaculis. Donec tempor iaculis dapibus.</p>', FALSE);
INSERT INTO artists VALUES(2, 'Iron Maiden', 'GB', 1975, '2.png', '2.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mollis id nibh ac luctus. Vestibulum interdum, ex ut elementum iaculis, lacus sem facilisis ex, ut pharetra libero mauris nec est. Vestibulum ac odio vel ipsum ultrices finibus nec rhoncus arcu. Vivamus vel neque sem. Nunc consequat dui semper, tristique dui ut, tristique tortor. Etiam tristique, augue vel tristique lacinia, magna dolor porttitor leo, a dignissim lectus justo a purus. Nulla nec elementum ipsum. Suspendisse pretium mi id magna porta, in faucibus lorem porttitor. Curabitur aliquam, urna ut ullamcorper scelerisque, magna lacus ornare est, non commodo augue nibh eu lectus. Vestibulum sodales massa sit amet metus viverra, eu dapibus nibh maximus. Vestibulum molestie tellus felis, eu feugiat dolor euismod a. Curabitur placerat iaculis cursus. Suspendisse potenti. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt interdum erat, id rutrum quam interdum eu. Mauris sodales felis eget efficitur mattis. Pellentesque tempus gravida enim a ultricies. Pellentesque vitae ultrices augue, non efficitur neque. Donec ac mattis tortor, sed volutpat mauris. Duis ultricies iaculis nisi eget pretium. Aliquam ornare sed libero sit amet iaculis. Donec tempor iaculis dapibus.</p>', FALSE);
INSERT INTO artists VALUES(3, 'Black Sabbath', 'GB', 1968, '3.png', '3.jpg', '<p>Phasellus lobortis consectetur erat in scelerisque. Ut viverra condimentum enim quis pretium. Aliquam nec velit erat. Quisque id velit porttitor, viverra urna a, consequat velit. Curabitur hendrerit pellentesque urna, id auctor metus luctus ac. Nulla facilisi. Nullam euismod pharetra mollis. Suspendisse sed bibendum urna, sed egestas sapien. Donec venenatis, arcu malesuada malesuada pulvinar, tellus purus efficitur massa, ut aliquam ipsum eros nec enim. Praesent dapibus elementum ullamcorper. In euismod semper mauris id pharetra. Donec ornare, diam hendrerit dictum elementum, nunc odio suscipit augue, sed pellentesque elit est vel massa. Nulla porttitor sem elit, non mattis augue mattis iaculis.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt interdum erat, id rutrum quam interdum eu. Mauris sodales felis eget efficitur mattis. Pellentesque tempus gravida enim a ultricies. Pellentesque vitae ultrices augue, non efficitur neque. Donec ac mattis tortor, sed volutpat mauris. Duis ultricies iaculis nisi eget pretium. Aliquam ornare sed libero sit amet iaculis. Donec tempor iaculis dapibus.</p>', FALSE);
INSERT INTO artists VALUES(4, 'Judas Priest', 'GB', 1969, '4.png', '4.jpg', '<p>Donec egestas, elit id semper lacinia, felis purus dapibus felis, sit amet semper nunc quam sit amet ligula. Nam sed accumsan lectus, eget finibus tellus. Aliquam venenatis nibh ex, finibus aliquet eros semper id. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam sit amet facilisis nisl. Nunc leo ipsum, mattis ac tellus in, luctus luctus nisl. Aenean commodo mollis ante a dapibus. Proin at ullamcorper nulla, at blandit nulla. Nam egestas finibus sapien. Etiam interdum laoreet sapien. Sed quis erat venenatis, dictum tellus eu, maximus nulla. Etiam vitae fringilla lorem, nec pretium justo. Duis eu sem tellus. Duis vel eleifend risus, quis ultrices sapien. Nullam consectetur posuere consequat. In hendrerit turpis vel nulla sagittis malesuada.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt interdum erat, id rutrum quam interdum eu. Mauris sodales felis eget efficitur mattis. Pellentesque tempus gravida enim a ultricies. Pellentesque vitae ultrices augue, non efficitur neque. Donec ac mattis tortor, sed volutpat mauris. Duis ultricies iaculis nisi eget pretium. Aliquam ornare sed libero sit amet iaculis. Donec tempor iaculis dapibus.</p>', FALSE);
INSERT INTO artists VALUES(5, 'Sepultura', 'BR', 1984, '5.png', '5.jpg', '<p>Aenean dignissim facilisis turpis, non gravida justo tempor in. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam non eros in ligula lacinia pharetra. In eleifend, arcu in rutrum sollicitudin, lectus urna efficitur elit, eu dignissim lectus metus a nibh. Nulla lobortis finibus massa sit amet vulputate. Mauris ut tincidunt nisi, a tincidunt lectus. Nunc molestie dolor enim, blandit ultrices enim iaculis eu. Integer tincidunt velit at mauris pellentesque vestibulum. Maecenas velit tellus, mollis vitae lorem nec, ornare interdum nulla. Ut gravida mollis bibendum. Donec scelerisque blandit tortor, ut venenatis urna commodo sed. Integer in nibh non orci condimentum scelerisque. Sed at eleifend arcu. In eget tortor eu mi pellentesque bibendum non in est. Morbi tincidunt lectus et turpis pellentesque aliquet.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt interdum erat, id rutrum quam interdum eu. Mauris sodales felis eget efficitur mattis. Pellentesque tempus gravida enim a ultricies. Pellentesque vitae ultrices augue, non efficitur neque. Donec ac mattis tortor, sed volutpat mauris. Duis ultricies iaculis nisi eget pretium. Aliquam ornare sed libero sit amet iaculis. Donec tempor iaculis dapibus.</p>', FALSE);


##genres(genreId, name, deleted)
DELETE FROM genres;
INSERT INTO genres VALUES(1, 'Other', FALSE);
INSERT INTO genres VALUES(2, 'Heavy Metal', FALSE);
INSERT INTO genres VALUES(3, 'Thrash Metal', FALSE);
INSERT INTO genres VALUES(4, 'Nu Metal', FALSE);


##records(recordId, genreId, title, releaseDate, cover, price, deleted)
DELETE FROM records;
INSERT INTO records VALUES(1, 3, 'Kill ''em All', '1983-07-25', '1.jpg', 09.99, FALSE);
INSERT INTO records VALUES(2, 3, 'Ride the Lightning', '1984-07-27', '2.jpg', 09.75, FALSE);
INSERT INTO records VALUES(3, 2, 'The Number of the Beast', '1982-03-22', '3.jpg', 12.15, FALSE);
INSERT INTO records VALUES(4, 2, 'Black Sabbath', '1970-02-13', '4.jpg', 08.99, FALSE);
INSERT INTO records VALUES(5, 2, 'Paranoid', '1970-09-18', '5.jpg', 08.99, FALSE);
INSERT INTO records VALUES(6, 2, 'Sad Wings of Destiny', '1976-03-23', '6.jpg', 07.50, FALSE);
INSERT INTO records VALUES(7, 2, 'British Steel', '1980-04-14', '7.jpg', 08.99, FALSE);
INSERT INTO records VALUES(8, 2, 'Painkiller', '1990-09-03', '8.jpg', 12.10, FALSE);
INSERT INTO records VALUES(9, 3, 'Chaos A.D.', '1993-10-19', '10.jpg', 11.30, FALSE);
INSERT INTO records VALUES(10, 4, 'Roots', '1996-02-20', '9.jpg', 11.70, FALSE);


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