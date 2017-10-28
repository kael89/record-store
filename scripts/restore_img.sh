#!/bin/bash
#@echo OFF
LOCATION="/opt/lampp/htdocs/record-store/img"

cd $LOCATION
if [ $1 = '-d' ]
then
    echo Clearing folder...
    sudo rm -r *
fi
sudo cp -r .backup/* .
echo Images successfully restored!