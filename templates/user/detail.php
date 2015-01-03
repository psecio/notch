<h2><?php echo $user['username']; ?></h2>

<table class="table">
	<tr>
		<td><b>Email:</b></td>
		<td><?php echo $user['email']; ?></td>
	</tr>
	<tr>
		<td><b>Created:</b></td>
		<td><?php echo $user['created']; ?></td>
	</tr>
	<tr>
		<td><b>Updated:</b></td>
		<td><?php echo $user['updated']; ?></td>
	</tr>
</table>

<?php if ($user['username'] == $currentUser): ?>
<a href="/user/edit/<?php echo $user['username']; ?>">Edit</a>
<?php endif; ?>