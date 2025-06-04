<div class="container">
    <?= $pagination ?>
    <?php
    foreach ($users as $user): ?>

    <div><?= $user['name'] ?></div>

    <?php
    endforeach; ?>
    <?= $pagination ?>
</div>
