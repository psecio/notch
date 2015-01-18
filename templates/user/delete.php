<h2>Deleting <?php echo $user['username']; ?></h2>

<?php if(isset($success)):
    $type = ($success === false) ? 'alert-danger' : 'alert-success';
    ?>
    <div class="alert <?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
<?php endif; ?>

<script type="text/javascript">
$(function() {
    $('#btn-no').click(function(e) {
        e.preventDefault();
        document.location.href = "/user/detail/<?php echo $user['username']; ?>";
    });
});
</script>

<p>
	Are you sure you want to delete user <b><?php echo $user['username']; ?></b>?
</p>
<form class="form-horizontal" role="form" action="/user/delete/<?php echo $user['username'];?>" method="post">
	<button type="submit" class="btn">Yes</button>
    <input type="button" id="btn-no" class="btn" value="No"/>
</form>