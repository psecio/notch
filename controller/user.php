<?php
/**
 * User routing
 */
$app->group('/user', function() use ($app, $di) {

    $app->get('/login', function() use ($app, $di) {
        $app->render('user/login.php');
    });
    $app->post('/login', function() use ($app, $di) {
        $message = 'Login successful!';

        $username = $app->request->post('username');
        $password = $app->request->post('password');

        $user = new Notch\Users($di);
        $success = $user->login($username, $password);

        if ($success === false) {
            $message = 'There was an error logging in!';
        } else {
            $userData = $user->getUserByUsername($username);
            $_SESSION['username'] = $userData['username'];
            $_SESSION['userId'] = $userData['id'];
        }

        $data = array(
            'success' => $success,
            'message' => $message
        );

        $app->render('user/login.php', $data);
    });
    $app->get('/register', function() use ($app, $di) {
        $app->render('user/register.php');
    });
    $app->post('/register', function() use ($app, $di) {
        $message = 'Success!';
        $posted = $app->request->post();
        $user = new Notch\Users($di);

        // Be sure we don't already have that user
        $find = $user->getUserByUsername($posted['username']);
        if (!empty($find)) {
            $success = false;
            $message = 'User "'.$posted['username'].'" already exists!';
        } else {
            $success = $user->create($posted);
            if ($success === false) {
                $message = 'There was an error creating the user!';
            }
        }

        $data = array(
            'success' => $success,
            'message' => $message
        );
        $app->render('user/register.php', $data);
    });
    $app->get('/logout', function() use ($app, $di) {
        unset($_SESSION['username']);
        $app->render('user/logout.php');
    });
});
?>