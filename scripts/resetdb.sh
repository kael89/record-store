#!/bin/bash
#@echo OFF
LOCATION="/opt/lampp/htdocs/record-store/sql"

echo Creating Database: record_store
cd $LOCATION
mysql -u root -pkkzara2017! < createDB.sql
mysql -u root -pkkzara2017! < populateDB.sql