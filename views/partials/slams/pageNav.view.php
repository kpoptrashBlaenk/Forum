<?php if (count($posts) !== 0) : ?>
<nav aria-label="Standard pagination example" class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="<?= pageURL($pages['back']) ?>" aria-label="Previous">
                <span aria-hidden="true" class="text-dark fs-5">«</span>
            </a>
        </li>
        <?php for ($i = 0; $i < min($pages['last'],3); $i++) : ?>
            <li class="page-item"><a class="page-link text-dark fs-5" href="<?= pageURL($i+1) ?>"><?= $i+1 ?></a></li>
        <?php endfor; ?>
        <?php if ($pages['last'] > 3) : ?>
            <li class="page-item"><a class="page-link text-dark fs-5">...</a></li>
            <li class="page-item"><a class="page-link text-dark fs-5" href="<?= pageURL($pages['last']) ?>"><?= $pages['last'] ?></a></li>
        <?php endif; ?>
        <li class="page-item">
            <a class="page-link" href="<?= pageURL($pages['next']) ?>" aria-label="Next">
                <span aria-hidden="true" class="text-dark fs-5">»</span>
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>
