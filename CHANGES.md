Changes - Authentication & Authorization
=======================

The main change here is the use of an authentication and authorization tool rather than no protection at all. For the
purposes of this example, we're going to use the `/user/delete` endpoint.

First off, though, we'll look at how it replaced the user registration and login handling. If you look in the
`controller/user.php` file and the `/login` route, you'll see the new code to use [Gatekeeper](http://github.com/pscio/gatekeeper), a user auth* tool.

## Login

```php
<?php
$credentials = array(
    'username' => $username,
    'password' => $password
);
$success = Gatekeeper::authenticate($credentials);
?>
```

This calls the `authenticate` method against the data in the Gatekeeper system to see if the username and password
match. If this works, the user is then fetched and information is put into the session.

## Registration

You'll see the same kinds of changes in the `/register` endpoint:

```php
<?php
$credentials = array(
    'username' => $posted['username'],
    'password' => $posted['password'],
    'email' => $posted['email']
);

try {
    $user = Gatekeeper::findUserByUsername($posted['username']);
    $message = 'User "'.$posted['username'].'" already exists!';
    $success = false;
} catch (\Exception $e) {
    // Not found - register!
    $success = Gatekeeper::register($credentials);
    if ($success === false) {
        $message = 'There was an error creating the user!';
    }
}
?>
```

This takes in a username, password and email address and uses the Gatekeeper library to store them. It inserts a row into its `users` table with a correctly hashed password (bcrypt).

## Authentication

The final piece of the puzzle comes with the authentication piece. Before our auth changes, you could directly access
the `/user/delete/:id` endpoint without any kind of checks. Now we've used the Gatekeeper system to ensure the user is in the correct group:

```php
<?php
$user = Gatekeeper::findUserById($_SESSION['userId']);
if ($user->inGroup('3') === false) {
    $app->redirect('/error');
}
?>
```

In this case, we've already set up an admin group as group #3 and we're checking to see if the current user belongs to it. If they don't we kick them back over to an error page.

**NOTE:** Be sure when securing endpoints you're not only putting it on the form page. Also check it on the endpoint the form is POSTed to. Without that, there's nothing preventing the attacker from POSTing directly to the endpoint, bypassing the form completely.


