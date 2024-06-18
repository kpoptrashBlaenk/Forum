<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="p-4 mx-3 mt-5 mb-4 bg-body-tertiary rounded-3 border border-dark position-relative">
    <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] === $post['user_id']) : ?>
        <div class="position-absolute top-0 end-0 mt-2 me-2">
            <form action="/slam" method="POST">
                <button type="button" class="btn btn-sm btn-primary me-2">
                    <a class="nav-link" href="<?= "/slam/edit?id={$post['id']}" ?>">Edit</a>
                </button>
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm btn-danger me-2">Delete</button>
            </form>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="row mb-3">
            <a class="fw-bold mb-0 text-secondary link-underline link-underline-opacity-0"
               href="/profile?user=<?= htmlspecialchars($post['username']) ?>&page=1">
                <?= htmlspecialchars($post['username']) ?>
            </a>
            <p class="fw-bold mb-0 text-secondary"><?= $post['date'] ?></p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold"><?= nl2br(htmlspecialchars($post['title'])) ?></h1>
                <p class="fs-4"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            </div>
        </div>
        <?php if ($post['user_has_liked'] > 0) : ?>
        <form action="/slam/like" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <?php else : ?>
            <form action="/slam/like" method="POST">
                <?php endif; ?>
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>"
                <div class="row mt-4">
                    <div class="col-md-8">
                        <?php if ($post['user_has_liked'] > 0) : ?>
                            <button type="submit" class="btn btn-sm rounded-pill btn-secondary me-2">
                                Unlike: <?= $post['num_likes'] ?></button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill me-2 border border-dark">
                                Like: <?= $post['num_likes'] ?></button>
                        <?php endif; ?>
                        <span class="badge border border-dark text-dark fs-6">
                        <img src="<?= resources($post['image_url']) ?>" alt="SQL" width="32" height="32" class="bi">
                        <?= $post['name'] ?>
                    </span>
                    </div>
                </div>
            </form>
    </div>
</div>


<hr class="mx-auto mb-4" style="width: 90%;">

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form id="commentArea" action="/slam/comment" method="POST">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <div class="mb-3">
                    <label for="comment" class="form-label fw-bold">Write a comment:</label>
                    <textarea class="form-control" id="comment" name="comment"
                              rows="3"><?= htmlspecialchars($editComment['comment'] ?? '') ?></textarea>
                </div>
                <?php require basePath('views/partials/errors.php') ?>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php if (isset($_GET['comment'])) : ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="comment_id" value="<?= $editComment['id'] ?>">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <button type="button" class="btn btn-danger"><a href="<?= removeParamURL('comment') ?>"> Cancel </a>
                    </button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <h3>Comments: <?= count($comments) ?></h3>
            <?php if (count($comments) === 0) : ?>
                <h1 class="my-5 text-secondary">Wow, so empty... :3</h1>
            <?php else : ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <?php if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] === $comment['user_id']) : ?>
                                <div class="position-absolute top-0 end-0 mt-2 me-2">
                                    <form action="slam/comment" method="POST">
                                        <button type="button" class="btn btn-sm btn-primary me-2">
                                            <a class="nav-link"
                                               href="<?= removeDuplicateURL('comment', $comment['id']) ?>">Edit</a>
                                        </button>
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger me-2">Delete</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <h5 class="card-title"><?= htmlspecialchars($comment['username']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($comment['comment']) ?></p>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>


<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
