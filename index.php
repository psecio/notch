<?php

require_once 'vendor/autoload.php';
require 'templates/header.php';

$app = new Slim\Slim();

$app->get('/', function() use ($app) {
	$app->render('index/index.php', array('test' => 'foo'));
});

$app->run();

require 'templates/footer.php';