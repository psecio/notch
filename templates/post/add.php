<h2><?php echo isset($postData) ? 'Edit' : 'Add New'; ?> Post</h2>

<?php if(isset($success)):
    $type = ($success === false) ? 'alert-danger' : 'alert-success';
    ?>
    <div class="alert <?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
<?php endif;

$url = (isset($postData)) ? '/post/edit/'.$postData['id'] : '/post/add';
?>

<form class="form-horizontal" role="form" method="POST" action="<?php echo $url; ?>">
    <div class="form-group">
        <label for="title" class="control-label col-sm-2">Title</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                value="<?php if (isset($postData['title'])) { echo $postData['title']; } ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="control-label col-sm-2">Content</label>
        <div class="col-sm-6">
        	<textarea name="content" id="content" class="form-control" rows="10" placeholder="Content..."><?php if (isset($postData['content'])) { echo $postData['content']; } ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn">
                <?php echo (isset($postData)) ? 'Update' : 'Post'; ?>
            </button>
        </div>
    </div>
</form>