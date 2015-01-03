<h2>Latest Posts</h2>
<br/>
<?php foreach ($posts as $post): ?>
<div class="post">
    <a class="title" href="/post/detail/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a><br/>
    <span class="date">
        <a href="/user/detail/<?php echo $post['author']; ?>"><?php echo $post['author']; ?></a>
        @ <?php echo $post['created']; ?>
    </span>
    <p class="content"><?php echo nl2br($post['content']); ?></p>
</div>
<br/>
<?php endforeach; ?>