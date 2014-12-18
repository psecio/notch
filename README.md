Notch: A Vulnerable Application
=================

mysqladmin create notch;
mysql -u root -p -e "grant all on notch.* to 'notch'@'localhost' identified by 'notch42'";