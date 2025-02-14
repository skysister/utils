<?php

site()->layoutInit();
site()->addPageTitle("Image Content");
site()->addJS("/app/js/imgcontent-js.php", "file");
$theme = "ssc-c"; // page theme

?>

<div class="page bar-top bar-btm bar-<?=$theme?>">
    <div class="container">
        <h1>Eve Image Content</h1>
        <div id="imgcontent-input">
            <p>Copy the JSON from <code>EVE Online/content.json</code>.</p>
            <div class="row">
                <div class="col-md-6">
                    <form id="imgcontent-form">
                        <textarea class="form-control content" rows="15" placeholder="...and paste it here."></textarea><br>
                        <button class="btn btn-primary btn-<?=$theme?>" data-imgcontent="onProcess">
                            Process
                        </button>
                        <button class="btn btn-outline btn-<?=$theme?>" data-imgcontent="onSampleData">
                            Sample Data
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <p>
                        File location varies by platform.<br>
                        macOS:<br>
                        <code class="ms-3">~/Library/Application Support/EVE Online/content.json</code><br>
                        Proton/Wine/Linux:<br>
                        <code class="ms-3">?</code> Do you know where this is? Maru needs your help!<br>
                        Windows:<br>
                        <code class="ms-3">?</code> Do you know where this is? Maru needs your help!<br>
                    </p>
                    <hr class="hr-ssc hr-<?=$theme?>">
                    <p>Feedback and correction is requested for these locations.</p>
                </div>
            </div>
        </div>
        <div id="imgcontent-output" class="mb-5" style="display: none;">
            <div class="content"></div>
            <button class="btn btn-primary btn-<?=$theme?>" data-imgcontent="onDismiss">OK</button>
        </div>
    </div>
</div>

<script id="imgcontent" type="x-tmpl-mustache">
{{#output}}
<h1>Creatives</h1>
{{#creatives}}
<hr>
<img class="img-fluid" src="{{.}}">
{{/creatives}}

<h1>Image Gallery</h1>
{{#imageGallery}}
<hr>
<div>
    <div class="d-flex mb-1 align-items-end info">
        <img src="{{thumb}}">
        <div class="ms-1"></div>
    </div>
    <img class="img-fluid measure-me" src="{{full}}">
</div>
{{/imageGallery}}

<h1>News Content</h1>
{{#newsContent}}
<hr>
<img class="img-fluid" src="{{.}}">
{{/newsContent}}
{{/output}}
</script>

<?=site()->layout()?>
