#!/bin/bash
#@echo OFF
LOCATION="/opt/lampp/htdocs/record-store/img"

cd $LOCATION
sudo cp -r .backup/* .
echo Images successfully restored!