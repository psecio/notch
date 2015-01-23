#!/bin/sh
# to be executed from root directory

mysql -uroot -e "drop database notch";
mysql -uroot -e "create database notch";
