<h2><?php echo $user['username']; ?></h2>

<table class="table">
	<tr>
		<td width="150"><b>Email:</b></td>
		<td><?php echo $user['email']; ?></td>
	</tr>
	<tr>
		<td width="150"><b>Created:</b></td>
		<td><?php echo $user['created']; ?></td>
	</tr>
	<tr>
		<td width="150"><b>Updated:</b></td>
		<td><?php echo $user['updated']; ?></td>
	</tr>
	<?php if (isset($user['avatar'])): ?>
	<tr>
		<td width="150"><b>Avatar:</b></td>
		<td><img src="/assets/img/uploads/<?php echo $user['avatar']; ?>" width="150"/></td>
	</tr>
	<?php endif; ?>
</table>

<?php if ($user['username'] == $currentUser): ?>
<a href="/user/edit/<?php echo $user['username']; ?>">Edit</a>
<?php endif; ?>