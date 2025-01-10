<?php

site()->layoutInit();
site()->addPageTitle("Diagnostics");

?>

<div class="page bar-top bar-btm bar-ssc-a">
    <div id="diagnostics" class="container text-white">

    <pre>
<?php
function env($var, $show = false) {
    echo "$var: ";
    $value = getenv($var);
    if ($value) {
        echo $show ? $value : "Present! Found " . strlen($value) . " characters.";
    } else {
        echo "Value not present.";
    }
    echo "\n";
}
?>
<?=__FILE__?> 

<a href="/info">PHP Info</a>

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
<?=env("SS_EXAMPLE")?>

<hr>
<?=env("SS_ESICLIENTID")?>

<hr>
<?=env("SS_ESICLIENTSECRET")?>

<hr>
Done.
</pre>

    </div>
</div>

<?=site()->layout()?>
