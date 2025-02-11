<?php

site()->layoutInit();
site()->addPageTitle("Material Analysis");
site()->addCSS("/app/css/material.css", "file");
site()->addJS("/app/js/material-js.php", "file");

?>

<div class="page bar-top bar-btm bar-ssc-c">
    <div class="container">
        <h1>Eve Material Analysis</h1>
        <div id="material-input">
            <p>Copy the material report from the Eve client as shown.</p>
            <div class="row">
                <div class="col-md-6">
                    <form id="material-form">
                        <textarea class="form-control content" rows="15" placeholder="...and paste it here."></textarea><br>
                        <button class="btn btn-primary btn-ssc-c" data-material="onAnalyze">
                            Analyze
                        </button>
                        <button class="btn btn-outline btn-ssc-c" data-material="onSampleData">
                            Sample Data
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="/app/rsrc/img/material-information.png">
                </div>
            </div>
        </div>
        <div id="material-output" class="mb-5" style="display: none;">
            <p>Prepared <span class="date"></span></p>
            <div class="content"></div>
            <div class="my-3 legend d-inline-flex flex-column">
                <div class="border-bottom border-top my-1 py-1 px-2 item-least-runs">
                    Limiting Material (least runs available)
                </div>
                <div class="border-bottom border-top my-1 py-1 px-2 item-most-runs">
                    Abundant Material (most runs available)
                </div>
            </div>
            <br>
            <button class="btn btn-primary btn-ssc-c" data-material="onDismiss">OK</button>
        </div>
        <hr class="hr-ssc hr-ssc-c">
        <p>Improvements:
            <ul class="marker-ssc marker-ssc-c">
                <li>Stablize output size</li>
            </ul>
        </p>
    </div>
</div>

<script id="material" type="x-tmpl-mustache">
<table class="table table-sm table-material w-auto text-white">
{{#sections}}
    <tr>
        <th colspan="4">
            <h4 class="m-0">{{name}}</h4>
        </th>
        <th class="gap"></th>
        <th colspan="2">
        {{#showCalculateFill}}
            <input type="number" class="form-control form-control-sm"
                title="Desired manufacture quantity"
                data-materialonchange="calculateFill"
            >
        {{/showCalculateFill}}
        </th>
    </tr>
    <tr>
        <th>Item</th>
        <th class="text-end">Required</th>
        <th class="text-end">Available</th>
        <th class="text-end">Runs</th>
        <th class="gap"></th>
        <th class="quantity text-end">Quantity</th>
        <th class="price text-end">Est. Ƶ</th>
    </tr>
{{#data}}
    <tr class="item{{#classes}} {{classes}}{{/classes}}">
        <td data-price="{{EstUnitPrice}}">
            {{Item}}
        </td>
        <td class="text-end" data-required="{{Required}}">
            {{FormattedRequired}}
        </td>
        <td class="text-end" data-available="{{Available}}">
            {{FormattedAvailable}}
        </td>
        <td class="text-end" data-runs="{{Runs}}">
            {{FormattedRuns}}
        </td>
        <td class="gap"></td>
        <td class="quantity text-end"></td>
        <td class="price text-end"></td>
    </tr>
{{/data}}
{{/sections}}
    <tr class="total">
        <th colspan="4">
            <h4 class="m-0">Total Estimated Price</h4>
        </th>
        <th class="gap"></th>
        <th>&nbsp;</th>
        <th class="price text-end"></th>
    </tr>
</table>
</script>

<?=site()->layout()?>
