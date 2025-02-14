<?php

site()->layoutInit();
site()->addPageTitle("Message of the Day");
site()->addCSS("/app/css/motd.css", "file");
site()->addJS("/app/js/motd-js.php", "file");
$theme = "ssc-a"; // page theme

?>

<div class="page bar-top bar-btm bar-<?=$theme?>">
    <div class="container">
        <h1>Message of the Day</h1>
        <div id="motd-input">
            <p>Copy the Loose Affiliations MotD in the <span class="text-white">Alliance</span> channel, from the Eve client as shown.</p>
            <div class="row">
                <div class="col-md-6">
                    <textarea class="form-control content" rows="15" placeholder="...and paste it here."></textarea><br>
                    <button class="btn btn-primary btn-<?=$theme?>" data-motd="onParse">
                        Show Channels and Passwords
                    </button>
                    <button class="btn btn-outline btn-<?=$theme?>" data-motd="onSampleData">
                        Sample Data
                    </button>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="/app/rsrc/img/copy-motd.png">
                    <p>This utility will parse the pasted MotD for channel names and associated passwords. It was designed and developed for Loose Affiliations, so it assumes the basic format shown in the copy instructions image.</p>
                </div>
            </div>
        </div>
        <div id="motd-output" style="display: none;">
            <div class="content"></div>
            <button class="btn btn-primary btn-<?=$theme?>" data-motd="onDismiss">OK</button>
        </div>
    </div>
</div>
<script id="motd" type="x-tmpl-mustache">
{{#message}}{{message}}{{/message}}
<table class="table table-sm table-motd w-auto text-white">
<tr>
    <th>Channel</th>
    <th>Password</th>
    <th></th>
</tr>
{{#matches}}
    <tr>
        <td class="channel">{{channel}}</td>
        <td class="password">{{password}}</td>
        <td>
            <button class="btn btn-sm btn-primary btn-<?=$theme?>" data-motd="onCopy">
                Copy
            </button>
        </td>
    </tr>
{{/matches}}
    <tr>
        <td>
            <input class="form-control form-control-sm"
                placeholder="Channel"
                name="channel"
            >
        </td>
        <td>
            <input class="form-control form-control-sm"
                placeholder="Password"
                name="password"
            >
        </td>
        <td>
            <button class="btn btn-sm btn-outline btn-<?=$theme?>" data-motd="onAdd">
                Add
            </button>
        </td>
    </tr>
</table>
<p>You can add another channel and password.</p>
</script>

<?=site()->layout()?>
