<?php
    use Illuminate\Support\Facades\URL; // Make sure to import the URL facade at the beginning of your PHP file
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1>Blog Posts</h1>

    <div class="mb-3">
        <form action="<?php echo URL::route('posts.create'); ?>" method="get" class="form-inline">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by title">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Create Post Form -->
    <div class="mb-3">
        <h2>Create New Blog Post</h2>
        <form action="<?php echo URL::route('posts.create'); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (Optional)</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    <!-- List of Posts -->
    <div class="row">
        <?php foreach ($posts as $post): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if ($post->image): ?>
                <img src="<?php echo asset('storage/' . $post->image); ?>" class="card-img-top" alt="Post Image">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post->title; ?></h5>
                    <p class="card-text"><?php echo $post->excerpt; ?></p>
                    <a href="<?php echo URL::route('posts.show', $post->id); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        <?php echo $posts->links(); ?>
    </div>

</div>

</body>
</html>
