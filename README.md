## Notch: A Vulnerable Application

Notch is a vulnerable PHP-based application only to be used for training purposes. **DO NOT** deploy this application in a production environment as it
has many known vulnerabilities that could lead to a compromise of your system.

### Create the database

mysqladmin create notch;

mysql -u root -p -e "grant all on notch.* to 'notch'@'localhost' identified by 'notch42'";
