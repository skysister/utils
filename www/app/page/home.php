<?php site()->layoutInit(); ?>
<?=site()->topBanner()?>

<div class="page bar-top bar-btm bar-ssc-a">
    <div class="container">
        <img class="maru-home" src="https://images.evetech.net/characters/1740039545/portrait?size=128">
        <h1>Greetings from Your Sky Sister</h1>
        <p>Sky Sister is a set of utilities written by Maru Skyborne.</p>
        <hr class="hr-ssc hr-ssc-a">
        <h2>Eve Online</h2>
        <a class="btn btn-primary btn-ssc-a my-1" href="/time">Time Stamp</a>
        <a class="btn btn-primary btn-ssc-a my-1" href="/material">Material Analysis</a>
        <a class="btn btn-primary btn-ssc-a my-1" href="/sov">Sovereignty</a>
        <a class="btn btn-primary btn-ssc-a my-1" href="/motd">Message of the Day</a>
        <hr class="hr-ssc hr-ssc-a">
        <p>Improvements:
            <ul class="marker-ssc marker-ssc-a">
                <li>Add Station Manager</li>
                <li>Text gradient generator</li>
                <li>Add Secret Project (shhh)</li>
                <li>Add DST Stuffer</li>
            </ul>
        </p>
    </div>
</div>
<style>
.maru-home { float: left; height: 80px; margin-right: 20px; width: auto; }
</style>

<?=site()->layout()?>
