<nav aria-label="Page navigation example">
    <ul class="pagination">

        <?php if (!empty($firstPage)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $firstPage ?>" aria-label="First Page">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($back)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $back ?>" aria-label="Previous Page">
                    <span aria-hidden="true">&lt;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if(!empty($pagesLeft)):?>
            <?php foreach ($pagesLeft as $item):?>
                <li class="page-item"><a class="page-link" href="<?= $item['link'] ?>"><?= $item['number'] ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>

        <li class="page-item active"><a class="page-link"><?= $currentPage ?></a></li>

        <?php if(!empty($pagesRight)):?>
            <?php foreach ($pagesRight as $item):?>
                <li class="page-item"><a class="page-link" href="<?= $item['link'] ?>"><?= $item['number'] ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($forward)): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $forward ?>" aria-label="Next Page">
                    <span aria-hidden="true">&gt;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($lastPage)): ?>
        <li class="page-item">
            <a class="page-link" href="<?= $lastPage ?>" aria-label="Last Page">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
