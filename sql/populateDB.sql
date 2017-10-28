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
INSERT INTO genres VALUES(1, 'Various', FALSE);
INSERT INTO genres VALUES(2, 'Other', FALSE);
INSERT INTO genres VALUES(3, 'Heavy Metal', FALSE);
INSERT INTO genres VALUES(4, 'Thrash Metal', FALSE);
INSERT INTO genres VALUES(5, 'Nu Metal', FALSE);


##records(recordId, genreId, title, releaseDate, cover, price, deleted)
DELETE FROM records;
INSERT INTO records VALUES(1, 4, 'Kill ''em All', '1983-07-25', '1.jpg', 09.99, FALSE);
INSERT INTO records VALUES(2, 4, 'Ride the Lightning', '1984-07-27', '2.jpg', 09.75, FALSE);
INSERT INTO records VALUES(3, 3, 'The Number of the Beast', '1982-03-22', '3.jpg', 12.15, FALSE);
INSERT INTO records VALUES(4, 3, 'Black Sabbath', '1970-02-13', '4.jpg', 08.99, FALSE);
INSERT INTO records VALUES(5, 3, 'Paranoid', '1970-09-18', '5.jpg', 08.99, FALSE);
INSERT INTO records VALUES(6, 3, 'Sad Wings of Destiny', '1976-03-23', '6.jpg', 07.50, FALSE);
INSERT INTO records VALUES(7, 3, 'British Steel', '1980-04-14', '7.jpg', 08.99, FALSE);
INSERT INTO records VALUES(8, 3, 'Painkiller', '1990-09-03', '8.jpg', 12.10, FALSE);
INSERT INTO records VALUES(9, 5, 'Roots', '1996-02-20', '9.jpg', 11.70, FALSE);
INSERT INTO records VALUES(10, 4, 'Chaos A.D.', '1993-10-19', '10.jpg', 11.30, FALSE);


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