<div data-template="<?=$template?>" class="page bar-top bar-btm bar-<?=$theme?>">
    <div class="container">
        <h1>Change Log</h1>
        <?php foreach ($entries as $entry) : ?>
            <?=site()->loadTemplate("content/change", $entry + compact("theme"))?>
        <?php endforeach; ?>
    </div>
</div>
