<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="mx-5">
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
        <div class="list-group w-100">

            <form id="slamsForm" action="/slams?page=1" method="GET">
                <div class="mb-4 border border-secondary">
                    <?php if (isset($_GET['category'])) : ?>
                        <input type="hidden" name="category" value="<?= htmlspecialchars($_GET['category']) ?>">
                    <?php endif; ?>
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search posts..." aria-label="Search"
                               name="search" value="<?= $_GET['search'] ?? '' ?>">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>

                <div class="my-3 d-flex justify-content-start">
                    <label for="sort_by" class="col-form-label me-2">Sort By:</label>
                    <div class="col-3">
                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="new" <?= ($sort_by === 'new') ? 'selected' : '' ?>>New</option>
                            <option value="hot" <?= ($sort_by === 'hot') ? 'selected' : '' ?>>Hot</option>
                            <option value="top" <?= ($sort_by === 'top') ? 'selected' : '' ?>>Top</option>
                        </select>
                    </div>
                </div>
            </form>
            <?php require basePath('views/partials/slams/index.view.php'); ?>
        </div>
    </div>
</div>

<?php require basePath('views/partials/slams/pageNav.view.php') ?>

<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
