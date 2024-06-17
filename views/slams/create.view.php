<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="container my-5">
    <h1 class="mb-4">Create a Slam</h1>
    <form action="/slams/create" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"><?= old('content') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Tag</label>
            <select class="form-select" id="category" name="category">
                <option <?= (old('category') !== null) ? 'selected' : '' ?> disabled value="">Choose a tag</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == old('category')) ? 'selected' : '' ?>><?= $category['name'] ?></option>
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
