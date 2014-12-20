<?php
session_start();

require_once 'vendor/autoload.php';
require 'templates/header.php';

use Pimple\Container;

// Custom autoloader
spl_autoload_register(function($class) {
    $path = __DIR__.'/lib/'.str_replace('\\', '/', $class).'.php';
    if (is_file($path)) {
        require_once $path;
    }
});

// Build out objects
$di = new Container();
$di['db'] = function()
{
    return new Notch\Database('127.0.0.1', 'notch', 'notch42', 'notch');
};

$app = new Slim\Slim();

/**
 * Index routing
 */
$app->get('/', function() use ($app, $di) {

    // Get the most recent posts
    $post = new Notch\Posts($di);
    $postList = $post->getLatest(10);

    var_export($postList);

	$app->render('index/index.php', array('test' => 'foo'));
});

/**
 * Posts routing
 */
$app->group('/post', function() use ($app, $di) {

    $app->get('/', function() use ($app, $di) {
        $app->render('post/index.php');
    });
    $app->get('/detail/:id', function($postId) use ($app, $di) {
        $post = new Notch\Posts($di);
        $data = array(
            'detail' => $post->getDetail($postId),
            'id' => $postId
        );
        $app->render('post/detail.php', $data);
    });
    $app->get('/add', function() use ($app, $di) {
        $app->render('post/add.php');
    });
});

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
            $_SESSION['username'] = $username;
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

$app->run();

require 'templates/footer.php';
