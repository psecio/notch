Changes - Direct Object Reference
=================================

The main changes here are to:

- Move the location of the image uploads outside of the document root
- Create a "stream" endpoint to return the user's image data

## Move the upload location

In the `controller/user.php` file we updated a few things. First we've added the `image` route:

```php
$app->get('/image/:username', function($username) use ($app, $di) {
	/** code here */
}
```

In this route we the the user by username and see if they have an avatar. If they do, we check for the file and
if it exists, grab the contents and send it to the `user/image.php` view. This just outputs the user image data
directly.

To make this work, I also had to add in a way to turn off the site template so the extra HTML markup didn't
break the image. I make a `CustomView` class in the `index.php` file and used that through Slim's configuration
to look for the `no-template` data value.

That takes care of viewing the image, lets see what changed for the upload. In the `controller/user.php` I've
updated the `/user/edit` route to change the path for the uploads:

```php
$image = realpath(__DIR__.'/../../notch-uploads').'/'.$userData['avatar'];
```

This moves it out of the document root and up one level. The "image" endpoint we made before can then pull from
this location and push the file contents out to the viewer. Normal users, however, cannot access this path (without
some other kind of vulnerability like a local file include).

**NOTE:** The `notch-uploads` directory will need to be created and the permissions changed so the web server
user can read and write to the directory. Obviously, don't just `chmod 777` it for security reasons - figure out
the least privilege.