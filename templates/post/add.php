<h2>Add New Post</h2>

<form class="form-horizontal" role="form" method="POST" action="/post/add">
    <div class="form-group">
        <label for="title" class="control-label col-sm-2">Title</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="control-label col-sm-2">Content</label>
        <div class="col-sm-6">
        	<textarea name="content" id="content" class="form-control" rows="10" placeholder="Content..."></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn">Post</button>
        </div>
    </div>
</form>