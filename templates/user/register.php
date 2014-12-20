<h2>User Registration</h2>

<?php if(isset($success)):
	$type = ($success === false) ? 'alert-danger' : 'alert-success';
	?>
    <div class="alert <?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
<?php endif; ?>

<form class="form-horizontal" role="form" method="POST" action="/user/register">
    <div class="form-group">
        <label for="username" class="control-label col-sm-2">Username</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username"/>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="control-label col-sm-2">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="control-label col-sm-2">Email</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn">Register</button>
        </div>
    </div>
</form>