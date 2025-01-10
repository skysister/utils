<div class="page bar-top bar-btm bar-<?=$theme?>">
    <div class="container">
        <h1>Change Log</h1>

        <?php foreach ($entries as $entry) : ?>
            <?php extract($entry); ?>
            <hr class="hr-ssc hr-<?=$theme?>">
            <h2>
                <?=$date?>
                <?php if (!empty($vers)) : ?>
                    <span class="badge badge-ssc-version badge-<?=$theme?>">
                        <?=$vers?>
                    </span>
                <?php endif; ?>
            </h2>
            <ul class="marker-ssc marker-<?=$theme?>">
                <?php foreach ($list as $item) : ?>
                    <li><?=$item?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>

    </div>
</div>
