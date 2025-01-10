<?php

site()->layoutInit();
site()->addPageTitle("Sovereignty");
site()->addJS("https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js", "file");
site()->addJS("/app/js/sov.js", "file");

?>

<div class="page bar-top bar-btm bar-ssc-e">
    <div class="container">
        <h1>Sovereignty</h1>
        <p>An ESI utility for generating sovereignty reports. Abuse will cause me to take this utility down.</p>
        <p><b>Claimed</b> generates the default report showing systems from the sovereignty map that have an alliance member.</p>
        <p><b>Contested</b> generates a secondary, shorter report showing systems from the sovereignty campaigns and shows status basics.</p>
        <div id="sov-btnbar" style="display: none;">
            <button class="btn btn-outline btn-ssc-e" data-sov="onCopy">
                Copy Table as CSV
            </button>
        </div>
        <div id="sov-output" style="display: none;"></div>
        <pre id="sov-log" class="font-monospace mb-3"></pre>
        <button class="btn btn-primary btn-ssc-e" data-sov="onClaimed">
            Claimed
        </button>
        <button class="btn btn-primary btn-ssc-e" data-sov="onContested">
            Contested
        </button>
    </div>
</div>
<script id="sov-claimed" type="x-tmpl-mustache">
<table class="table table-ms w-auto text-white">
    <tr>
        <th>Claimed</th>
        <th>Alliance</th>
        <th>Ticker</th>
    </tr>
{{#systems}}
    <tr>
        <td>{{system.name}}</td>
        <td>{{alliance.name}}</td>
        <td>{{alliance.ticker}}</td>
    </tr>
{{/systems}}
</table>
</script>
<script id="sov-contested" type="x-tmpl-mustache">
<table class="table table-ms w-auto text-white">
    <tr>
        <th>Contested</th>
        <th>Event</th>
        <th data-sov="onSwapTime">
            <span class="time time-eve">Start (Eve Time)</span>
            <span class="time time-local" style="display: none;">Start (Your Local Time)</span>
        </th>
        <th>Attackers Score</th>
        <th>Defender</th>
        <th>Ticker</th>
        <th>Defender Score</th>
    </tr>
{{#systems}}
    <tr>
        <td>{{system.name}}</td>
        <td>{{event_type}}</td>
        <td data-sov="onSwapTime">
            <span class="time time-eve">{{time.eve}}</span>
            <span class="time time-local" style="display: none;">{{time.local}}</span>
        </td>
        <td class="text-center">{{attackers_score}}</td>
        <td>{{alliance.name}}</td>
        <td>{{alliance.ticker}}</td>
        <td class="text-center">{{defender_score}}</td>
    </tr>
{{/systems}}
</table>
</script>

<?=site()->layout()?>
