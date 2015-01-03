<h2>Edit <?php echo $user['username']; ?></h2>

<?php if(isset($success)):
	$type = ($success === false) ? 'alert-danger' : 'alert-success';
	?>
    <div class="alert <?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
<?php endif; ?>

<form class="form-horizontal" role="form" method="POST"
	action="/user/edit/<?php echo $user['username']; ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="password" class="control-label col-sm-2">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="password" value="<?php echo $user['password']; ?>"
            	name="password" placeholder="Password"/>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="control-label col-sm-2">Email</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="email" name="email"
            	value="<?php echo $user['email']; ?>" placeholder="Email Address"/>
        </div>
    </div>
    <div class="form-group">
    	<label for="upload" class="control-label col-sm-2">Avatar upload</label>
    	<div class="col-sm-4">
    		<input type="file" class="form-control" name="avatar" id="avatar">
    	</div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn">Save</button>
        </div>
    </div>
</form>