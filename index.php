<?php
session_start();

require_once 'vendor/autoload.php';

use Pimple\Container;

class CustomView extends \Slim\View
{
    public function render($template)
    {
        $data = $this->data->all();

        if (!isset($data['no-template']) || $data['no-template'] === false) {
            require 'templates/header.php';
        }

        extract($data);
        require_once __DIR__.'/templates/'.$template;

        if (!isset($data['no-template']) || $data['no-template'] === false) {
            require 'templates/footer.php';
        }
    }
}

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

$app = new Slim\Slim(array(
    'debug' => true,
    'view' => new CustomView()
));
$app->error(function (\Exception $e) use ($app) {
    // do nothing...
});

/**
 * Index routing
 */
$app->get('/', function() use ($app, $di) {

    // Get the most recent posts
    $post = new Notch\Posts($di);
    $postList = $post->getLatest(10);

    $data = array(
        'posts' => $postList
    );

	$app->render('index/index.php', $data);
});

// Other controllers
require 'controller/posts.php';
require 'controller/user.php';

$app->run();
