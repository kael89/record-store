#!/bin/bash
#@echo OFF
LOCATION="/opt/lampp/htdocs/record-store/sql"

cd $LOCATION
echo Database: record_store
echo ----------------------
echo Creating Database...
mysql -u root -pkkzara2017! < createDB.sql
echo Populating Database...
mysql -u root -pkkzara2017! < populateDB.sql
echo Done!