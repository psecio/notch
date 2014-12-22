## Notch: A Vulnerable Application

Notch is a vulnerable PHP-based application only to be used for training purposes. **DO NOT** deploy this application in a production environment as it
has many known vulnerabilities that could lead to a compromise of your system.

### Manual installation

You can install a Notch instance manually in a few simple steps:

1. `git clone` the repo into a web accessible directory, like `/var/www/notch`
2. Run a `composer.phar install` to get all dependencies
3. Create the database needed:

```
mysqladmin create notch;
mysql -u root -p -e "grant all on notch.* to 'notch'@'localhost' identified by 'notch42'";
```

4. Run the migrations: `vendor/bin/phinx migrate`

This should get you up and running with your basic site and a bit of content.

### Vagrant installation

A Vagrant setup has been provided in the `vagrat/` directory making it a one command install once it's cloned:

```
cd vagrant; vagrant up
```

One thing to note here though - the Vagrant setup uses name-based virtual hosts, so you'll need to add this
to your `/etc/hosts`:

```
192.168.1.100 notch.localhost
```

### The vulnerabilities

There are several vulnerabilities that are purposefully included in the Notch application based on the OWASP
Top 10 list including:

- SQL injection (A1)
- Broken Authentication & Session Management (A2)
- Cross-site scripting (A3)
- Insecure Direct Object References (A4)
- Sensitive Data Exposure (A6)

There are places in the application where comments with the word "Hint" have been placed to help guide you to locate
the issues. As this is being used for a tutorial at the PHP Benelux conference, I'm not going to show them just yet :)