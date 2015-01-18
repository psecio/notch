Changes - SQL Injection
=======================

The main change here for preventing SQL injections is moving from the `mysql_*` functions to `PDO` and using
prepared statements. The updates for this are in the `lib/Notch` directory files:

- lib/Notch/Database.php
- lib/Notch/Users.php
- lib/Notch/Posts.php

The `Database` class is updated to create a `PDO` instance in the constructor which is then used in the rest
of the class methods. Then in the `Post` and `Users` classes, the queries are updated. For example, in the user
login handling it goes from this:

```php
public function login($username, $password)
{
    $sql = 'select * from users where username = "'.$username.'" and password = "'.$password.'"';
    $result = $this->getDb()->fetchOne($sql);
    return (empty($result)) ? false : true;
}
```

to this:

```php
public function login($username, $password)
{
    $sql = 'select * from users where username = :username and password = :password';
    $data = array(
        ':username' => $username,
        ':password' => $password
    );
    $result = $this->getDb()->fetchOne($sql, $data);
    return (empty($result)) ? false : true;
}
```

While the second example looks like more code (and it is) it's safer because the values for `username` and
`password` are not concatenated into the SQL. Instead the SQL statement with the placeholders is sent off
to the server and is then executed with the two pieces of data provided once the `fetchOne` method is called.