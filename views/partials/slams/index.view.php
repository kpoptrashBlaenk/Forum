<?php foreach ($posts as $post): ?>
    <a href="/slam?id=<?= $post['id'] ?>"
       class="list-group-item list-group-item-action d-flex gap-3 py-3"
       aria-current="true">
        <img src="<?= resources($post['image_url']) ?>" alt="<?= $post['name'] ?>" width="32" height="32"
             class="rounded-circle flex-shrink-0">
        <div class="flex-grow-1">
            <h6 class="mb-0"><?= htmlspecialchars($post['title']) ?></h6>
            <p class="mb-0 opacity-75"><?= htmlspecialchars($post['content']) ?></p>
            <div class="d-flex justify-content-start mt-2">
                <p class="mb-0 text-danger">Likes: <?= $post['num_likes'] ?></p>
                <p class="mb-0 mx-3 text-tertiary">Comments: <?= $post['num_comments'] ?></p>
            </div>
        </div>
        <div class="ms-auto text-end">
            <small class="opacity-50 text-nowrap"><?= $post['date'] ?></small>
            <small class="d-block mb-0 opacity-75"><?= htmlspecialchars($post['username']) ?></small>
        </div>
    </a>
<?php endforeach; ?>

