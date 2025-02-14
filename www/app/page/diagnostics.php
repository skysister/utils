<?php

site()->layoutInit();
site()->addPageTitle("Diagnostics");
$theme = "ssc-a"; // page theme

?>

<div class="page bar-top bar-btm bar-<?=$theme?>">
    <div id="diagnostics" class="container text-white">

    <pre>
<?=__FILE__?> 

Starting.

<hr>
Release
<?php $release = shell_exec('lsb_release -a'); ?>
<?=$release?>

<hr>
PHP Version
<?php $php = phpversion(); ?>
<?=$php?> 

<hr>
<?=site()->env("SS_ESICLIENTID")?>

<hr>
<?=site()->env("SS_ESICLIENTSECRET")?>

<hr>
Done.
</pre>

    </div>
</div>

<?=site()->layout()?>
