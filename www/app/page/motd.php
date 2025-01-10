<?php

site()->layoutInit();
site()->addPageTitle("Message of the Day");
site()->addCSS("/app/css/motd.css", "file");
site()->addJS("/app/js/motd.js", "file");

?>

<div class="page bar-top bar-btm bar-ssc-a">
    <div class="container">
        <h1>Message of the Day</h1>
        <div id="motd-ui">
            <p>Copy the Loose Affiliations MotD in the <span class="text-white">Alliance</span> channel, from the Eve client as shown.</p>
            <div class="row">
                <div class="col-md-6">
                    <textarea class="form-control" id="motdInput" rows="15" placeholder="...and paste it here."></textarea><br>
                    <button class="btn btn-primary btn-ssc-a" data-motd="onParse">
                        Show Channels and Passwords
                    </button>
                    <button class="btn btn-outline btn-ssc-a" data-motd="onSampleData">
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
            <div class="result"></div>
            <button class="btn btn-primary btn-ssc-a" data-motd="onDismiss">OK</button>
        </div>
    </div>
</div>
<script id="motd-result" type="x-tmpl-mustache">
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
            <button class="btn btn-sm btn-primary btn-ssc-a" data-motd="onCopy">
                Copy
            </button>
        </td>
    </tr>
{{/matches}}
</table>
</script>

<?=site()->layout()?>
