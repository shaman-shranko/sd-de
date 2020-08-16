#!/bin/bash

rm -rf /home/insurancetruck/assets/bundle/*
mkdir /home/insurancetruck/uploads/charts
chown apache:apache /home/insurancetruck/uploads/charts
chmod 777 /home/insurancetruck/uploads/charts

/website.sh