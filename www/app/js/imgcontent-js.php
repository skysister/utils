<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("imgcontent.json");
$sampleData = json_encode(file_get_contents($sampleDataPath));
$obj = "imgcontent";

?>

var <?=$obj?> = {
    input: {
        content: "#<?=$obj?>-input .content",
        ui: "#<?=$obj?>-input"
    },
    output: {
        content: "#<?=$obj?>-output .content",
        template: "#<?=$obj?>",
        ui: "#<?=$obj?>-output"
    },

    onDocumentReady: function () {
        OnClick.install("<?=$obj?>"); // attaches click handlers
    },

    onProcess: function() {
        var input = JSON.parse($(<?=$obj?>.input.content).val());
        
        var output = {};
        Object.keys(input["eve-online"].en).forEach(k => {
            var method = k + "Process";
            if (typeof <?=$obj?>[method] != "function") {
                console.info("Aborting: no method named " + method + " found on <?=$obj?>.");
                return;
            }
            output[k] = <?=$obj?>[method](input["eve-online"].en[k]);
        });

        // output
        $(<?=$obj?>.output.content).empty()
            .append(Mustache.render(
                $(<?=$obj?>.output.template).html(), { output }
            ));

        $(".measure-me").on("load", function() {
            var img = this;
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var info = "Image size: " + w + " x " + h;

            var gcd = <?=$obj?>.greatestCommonDivisor(w, h);
            if (gcd != 1 && w/gcd < 100) {
                info += "<br>Aspect: " + w/gcd + ":" + h/gcd;
            }

            $(img).siblings(".info").find("div").html(info);
        });

        // toggle view
        $(<?=$obj?>.input.ui).hide();
        $(<?=$obj?>.output.ui).show();
    },

    greatestCommonDivisor: function(w, h) {
        return (h == 0)
            ? w : <?=$obj?>.greatestCommonDivisor(h, w%h);
    },

    creativesProcess: function(data) {
        const creatives = data.creatives;
        var output = [];

        creatives.forEach(c => {
            output.push(c.image.slice(6));
        });

        return output;
    },

    imageGalleryProcess: function(data) {
        const items = data.items;
        var output = [];

        items.forEach(i => {
            output.push({
                thumb: i.thumb,
                full: i.full
            });
        });

        return output;
    },

    newsContentProcess: function(data) {
        const entities = data.entities;
        var output = [];

        Object.keys(entities).forEach(k => {
            output.push(entities[k].src);
        });

        return output;
    },

    onDismiss: function () {
        // empty input
        $(<?=$obj?>.input.content).val("");

        // toggle view
        $(<?=$obj?>.input.ui).show();
        $(<?=$obj?>.output.ui).hide();
    },

    onSampleData: function() {
        $(<?=$obj?>.input.content).val(<?=$sampleData?>);
    }
};

$(<?=$obj?>.onDocumentReady);
