#!/bin/sh
# to be executed from root directory

mysql -uroot -e "drop database notch";
mysql -uroot -e "create database notch";
mysql -uroot -e "grant all on notch.* to 'notch'@'localhost' identified by 'notch42'";
vendor/bin/phinx migrate