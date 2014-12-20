<h2>User Login</h2>

<?php if(isset($success)):
    $type = ($success === false) ? 'alert-danger' : 'alert-success';
    ?>
    <div class="alert <?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
<?php endif; ?>

<!-- Hint [SQLi]: " or 1=1; # -->
<form class="form-horizontal" role="form" method="POST" action="/user/login">
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
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn">Login</button>
        </div>
    </div>
</form>
<br/>
Don't have a login? <a href="/user/register">Register here</a>