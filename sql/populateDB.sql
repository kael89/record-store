USE record_store;

#users(userId,firstName,lastName,email,password,admin)
DELETE FROM users;
INSERT INTO users VALUES(1,'Kostas','Karvounis','kos.karvounis.zoumpos@gmail.com','11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1',TRUE);
INSERT INTO users VALUES(2,'Kostas','Karvounis','kael1989@gmail.com','11875FF7B881A3BFE8550E09ACD28F8E57DC24933C0B4053300E588E9B97D6B1',TRUE);
#INSERT INTO users VALUES(3,'Elena','Kyriaki','elena.kyriaki@gmail.com','2E8F5D4AA19B860AEB84E2A6C45713D81F009FD2E691356B17FF76FBABDF47B2',FALSE);
#INSERT INTO users VALUES(4,'Alexis','Karvounis','al3xkarv@gmail.com','EC03ACE04805C0B06CE7A3E7D6882B9311714CC03C342EA60B6A30A411994313',FALSE);