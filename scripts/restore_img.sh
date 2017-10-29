#!/bin/bash
#@echo OFF
LOCATION="/opt/lampp/htdocs/record-store/img"

cd $LOCATION
if [ $# -gt 0 ] && [ $1 == "-d" ]
then
    echo Clearing folder...
    sudo rm -r *
fi
sudo cp -r .backup/* .
sudo chmod +777 * -R
echo Images successfully restored!