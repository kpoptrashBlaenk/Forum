<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="container my-5">
    <h1 class="mb-4">Edit your Slam</h1>
    <form action="/slam" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= (strlen(old('title')) === 0) ? $post['title'] : old('title') ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"><?= (strlen(old('content')) === 0) ? $post['content'] : old('content') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Tag</label>
            <select class="form-select" id="category" name="category">
                <option disabled value="">Choose a tag</option>
                <?php foreach($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == old('category') || $category['id'] == $post['category_id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php foreach ($errors as $error) : ?>
            <p class="text-danger mt-2"><?= $error ?></p>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</div>

<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
