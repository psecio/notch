<?php
/**
 * Posts routing
 */
$app->group('/post', function() use ($app, $di) {

    // Post main route
    $app->get('/', function() use ($app, $di) {
        $app->render('post/index.php');
    });

    // Hint [Auth]: Protection?
    $app->get('/detail/:id', function($postId) use ($app, $di) {
        $post = new Notch\Posts($di);
        $postData = $post->getDetail($postId);
        $success = true;

        $user = new Notch\Users($di);
        $userData = $user->getUserByUsername($postData['author']);

        if ($postData == null) {
            $success = false;
        }

        $data = array(
            'post' => $postData,
            'success' => $success,
            'id' => $postId,
            'user' => $userData,
            'currentUser' => @$_SESSION['username']
        );
        $app->render('post/detail.php', $data);
    });

    // Post/add routes/....
    $app->get('/add', function() use ($app, $di) {
        $app->render('post/add.php');
    });
    $app->post('/add', function() use ($app, $di) {
        $posted = $app->request->post();
        $success = true;
        $message = 'Post created successfully!';
        $posted['author'] = $_SESSION['username'];

        $post = new Notch\Posts($di);
        $success = $post->create($posted);

        if ($success == false) {
            $message = 'There was an error creating the post!';
        }

        $data = array(
            'success' => $success,
            'message' => $message
        );
        $app->render('post/add.php', $data);
    });

    // Post delete routes
    $app->get('/delete/:id', function($postId) use ($app, $di) {
        $post = new Notch\Posts($di);
        $postData = $post->getDetail($postId);
        $data = array(
            'post' => $postData
        );
        $app->render('post/delete.php', $data);
    });

    // Hint [Auth]: Protection?
    // Hint [CSRF]: Protection?
    $app->post('/delete/:id', function($postId) use ($app, $di) {
        $post = new Notch\Posts($di);
        $postData = $post->getDetail($postId);
        $message = 'Post deleted successfully!';

        $success = $post->delete($postId);

        if ($success == false) {
            $message = 'There was an error deleting the post!';
        }

        $data = array(
            'post' => $postData,
            'success' => $success,
            'message' => $message
        );

        $app->render('post/delete.php', $data);
    });

    $app->get('/edit/:id', function($postId) use ($app, $di) {
        $post = new Notch\Posts($di);
        $data = array(
            'postData' => $post->getDetail($postId)
        );

        $app->render('/post/add.php', $data);
    });
    $app->post('/edit/:id', function($postId) use ($app, $di) {
        $posted = $app->request->post();
        $posted['author'] = @$_SESSION['username'];
        $posted['id'] = $postId;

        $post = new Notch\Posts($di);
        $success = $post->save($posted);
        $message = 'Post saved successfully!';

        if ($success == false) {
            $message = 'There was an error editing the post!';
        }

        $data = array(
            'postData' => $post->getDetail($postId),
            'success' => $success,
            'message' => $message
        );

        $app->render('post/add.php', $data);
    });
});
?>