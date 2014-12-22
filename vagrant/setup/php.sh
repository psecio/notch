#!/usr/bin/env bash

# Let's do some apt updates!
echo -e "Installing PHP\n"
sudo apt-get update > /dev/null 2>&1
sudo apt-get -y install php5 > /dev/null 2>&1
sudo apt-get -y install php5-mysql > /dev/null 2>&1

echo -e "Installing MySQL\n"
echo "mysql-server-5.5 mysql-server/root_password password root" | sudo debconf-set-selections
echo "mysql-server-5.5 mysql-server/root_password_again password root" | sudo debconf-set-selections
sudo apt-get -y install mysql-server-5.5 > /dev/null
sudo apt-get -y install mysql-client-5.5 > /dev/null
sudo apt-get -y install mysql-common > /dev/null

echo -e "Building Notch database and account"
sudo mysqladmin --user=root --password=root create notch
sudo mysql --user=root --password=root -e "GRANT ALL on notch.* to 'notch'@'localhost' identified by 'notch42'"
sudo mysql --user=root --password=root -e "flush privileges;"

echo -e "Checking out Notch"
sudo apt-get -y install git  > /dev/null 2>&1
sudo git clone https://github.com/psecio/notch.git /var/www/notch > /dev/null

echo -e "Running Composer"
sudo wget https://getcomposer.org/composer.phar > /dev/null 2>&1
cd /var/www/notch
sudo php /home/vagrant/composer.phar install > /dev/null 2>&1

echo -e "Running migrations"
sudo vendor/bin/phinx migrate

echo -e "Adding Notch site to default apache config"
sudo mkdir /var/log/notch
sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
cat /vagrant/setup/notch.conf >> /etc/apache2/sites-available/000-default.conf
sudo /etc/init.d/apache2 restart

# Change permissions so Apache can write to it
sudo chown -R www-data /var/www/notch