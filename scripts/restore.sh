#!/bin/bash
#@echo OFF
ROOT="../"

set -e
echo Restoring Database...
echo Connecting to local MySQL/MariaDB database
cat $ROOT/sql/*.sql | mysql -u root -p
echo Done!

echo Restoring images...
read -p "This will delete all files under 'img/' folder. Proceed? [y/n]" ans
if [ $ans == "y" ] || [ $ans == "Y" ]
then
    sudo rm -r $ROOT/img/*
    sudo cp -r $ROOT/img/.backup/* $ROOT/img/
    sudo chmod +777 $ROOT/img/* -R
    echo Done!
fi