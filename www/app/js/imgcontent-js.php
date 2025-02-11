<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("imgcontent.json");
$sampleData = json_encode(file_get_contents($sampleDataPath));

?>

var imgcontent = {
    onDocumentReady: function () {
        OnClick.install("imgcontent"); // attaches click handlers
    },

    onSampleData: function() {
        $("#imgcontent-input").val(<?=$sampleData?>);
    },

    onProcess: function() {
        var input = JSON.parse($("#imgcontent-input").val());
        
        var output = {};
        Object.keys(input["eve-online"].en).forEach(k => {
            var method = k + "Process";
            if (typeof imgcontent[method] != "function") {
                console.info("Aborting: no method named " + method + " found on imgcontent.");
                return;
            }
            output[k] = imgcontent[method](input["eve-online"].en[k]);
        });

        // output
        $("#imgcontent-output .the-content").empty()
            .append(Mustache.render(
                $("#imgcontent").html(), { output }
            ));

        $(".measure-me").on("load", function() {
            var img = this;
            var w = img.naturalWidth;
            var h = img.naturalHeight;
            var info = "Image size: " + w + " x " + h;

            var gcd = imgcontent.greatestCommonDivisor(w, h);
            if (gcd != 1 && w/gcd < 100) {
                info += "<br>Aspect: " + w/gcd + ":" + h/gcd;
            }

            $(img).siblings(".info").find("div").html(info);
        });

        // toggle view
        $("#imgcontent-ui").hide();
        $("#imgcontent-output").show();
    },

    greatestCommonDivisor: function(w, h) {
        return (h == 0)
            ? w : imgcontent.greatestCommonDivisor(h, w%h);
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
        $("#imgcontent-input").val("");

        // toggle view
        $("#imgcontent-ui").show();
        $("#imgcontent-output").hide();
    }
};

$(imgcontent.onDocumentReady);
