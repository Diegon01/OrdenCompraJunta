<?php $pager->setSurroundCount(0) ?>

<nav aria-label="Page navigation">
    <ul class="pagination">

    
    <?php if ($pager->hasPrevious()) : ?>
        <div class="flex bg-blue-200 m-4 rounded-lg shadow-lg">
    <div class="flex bg-blue-200 m-4">
        <li>
            <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true">⇐ ⇐ Primera</span>
            </a>
        </li>
        </div>
    </div>
    <?php endif ?>
    <?php $pager->setSurroundCount(2) ?>
    <div class="flex bg-blue-200 m-4 rounded-lg shadow-lg">
    <div class="flex bg-blue-200 m-4">
    <?php if ($pager->hasPrevious()) : ?>
        <h2 class="text-2xl font-semibold text-center text-blue-500 mb-6">...</h2>
    <?php endif ?>
    <?php foreach ($pager->links() as $link): ?>
        <li <?= $link['active'] ? 'class="active"' : '' ?>>
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>
    <?php if ($pager->hasNext()) : ?>
        <h2 class="text-2xl font-semibold text-center text-blue-500 mb-6">...</h2>
    <?php endif ?>
    </div>
    </div>
    <?php $pager->setSurroundCount(0) ?>
    
    <?php if ($pager->hasNext()) : ?>
        <div class="flex bg-blue-200 m-4 rounded-lg shadow-lg">
        <div class="flex bg-blue-200 m-4">
        <li>
            <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true">Última ⇒ ⇒</span>
            </a>
        </li>
        </div>
        </div>
    <?php endif ?>
    </ul>
</nav>