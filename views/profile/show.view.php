<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="mx-5">
    <div class="p-4 mx-3 mt-5 mb-4 bg-body-tertiary rounded-3 border border-dark position-relative">
        <h1 class="text-center display-5 fw-bold"><?= $_GET['user'] ?></h1>
    </div>

    <hr class="mx-auto mb-0" style="width: 90%;">

    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
        <div class="list-group w-100">
            <form id="slamsForm" action="/profile" method="GET">
                <div class="my-3 d-flex justify-content-start">
                    <input type="hidden" name="user" value="<?= $_GET['user'] ?>">
                    <label for="sort_by" class="col-form-label">Sort By:</label>
                    <div class="col-3 mx-3">
                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="new" <?= ($sort_by === 'new') ? 'selected' : '' ?>>New</option>
                            <option value="top" <?= ($sort_by === 'top') ? 'selected' : '' ?>>Top</option>
                        </select>
                    </div>
                </div>
            </form>

            <?php if (count($posts) === 0) : ?>
                <h1 class="my-5 text-secondary text-center">Wow, so empty... :3</h1>
            <?php else : ?>
                <h3 class="mt-5 mb-3">Posts: <?= count($posts) ?></h3>
                <?php require basePath('views/partials/slams/index.view.php'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require basePath('views/partials/slams/pageNav.view.php') ?>

<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
