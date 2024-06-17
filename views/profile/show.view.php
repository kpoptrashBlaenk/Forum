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
                <?php foreach ($posts as $post): ?>
                    <a href="/slam?id=<?= $post['id'] ?>"
                       class="list-group-item list-group-item-action d-flex gap-3 py-3"
                       aria-current="true">
                        <img src="<?= resources($post['image_url']) ?>" alt="<?= $post['name'] ?>" width="32"
                             height="32"
                             class="rounded-circle flex-shrink-0">
                        <div class="flex-grow-1">
                            <h6 class="mb-0"><?= $post['title'] ?></h6>
                            <p class="mb-0 opacity-75"><?= $post['content'] ?></p>
                            <div class="d-flex justify-content-start mt-2">
                                <p class="mb-0 text-danger">Likes: <?= $post['num_likes'] ?></p>
                                <p class="mb-0 mx-3 text-tertiary">Comments: <?= $post['num_comments'] ?></p>
                            </div>
                        </div>
                        <div class="ms-auto text-end">
                            <small class="opacity-50 text-nowrap"><?= $post['date'] ?></small>
                            <small class="d-block mb-0 opacity-75"><?= $post['username'] ?></small>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<nav aria-label="Standard pagination example" class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="<?= pageURL($pages['back']) ?>" aria-label="Previous">
                <span aria-hidden="true" class="text-dark fs-5">«</span>
            </a>
        </li>
        <?php for ($i = 0; $i < min($pages['last'], 3); $i++) : ?>
            <li class="page-item"><a class="page-link text-dark fs-5" href="<?= pageURL($i + 1) ?>"><?= $i + 1 ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($pages['last'] > 3) : ?>
            <li class="page-item"><a class="page-link text-dark fs-5">...</a></li>
            <li class="page-item"><a class="page-link text-dark fs-5"
                                     href="<?= pageURL($pages['last']) ?>"><?= $pages['last'] ?></a></li>
        <?php endif; ?>
        <li class="page-item">
            <a class="page-link" href="<?= pageURL($pages['next']) ?>" aria-label="Next">
                <span aria-hidden="true" class="text-dark fs-5">»</span>
            </a>
        </li>
    </ul>
</nav>

<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
