<br/>
<?php if ($success == true): ?>
<div class="post">
    <a class="title" href="/post/detail/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a><br/>
    <span class="date">
        <a href="/user/detail/<?php echo $post['author']; ?>"><?php echo $post['author']; ?></a>
        @ <?php echo $post['created']; ?>
    </span>
    <p class="content"><?php echo nl2br($post['content']); ?></p>
</div>
<?php else: ?>
<div class="alert alert-danger" role="alert">Invalid post!</div>
<?php endif; ?>

<?php if ($post['author'] === $currentUser): ?>
    <a href="/post/delete/<?php echo $post['id']; ?>">Delete</a><br/>
    <a href="/post/edit/<?php echo $post['id']; ?>">Edit</a>
<?php endif; ?>