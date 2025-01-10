<!-- begin <?=$template?> -->
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
<!-- end <?=$template?> -->
