<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("motd.txt");
$sampleData = json_encode(file_get_contents($sampleDataPath));
$obj = "motd";

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
        console.log("<?=$obj?>.onDocumentReady()");
        OnClick.install("<?=$obj?>"); // attaches click handlers
        ssStorage.install("<?=$obj?>");
        <?=$obj?>.checkStorage();
    },

    checkStorage: function() {
        var matches = <?=$obj?>.read("matches");
        if (matches) {
            const msg = "Found these entries from before.";
            <?=$obj?>.show(matches, msg);
        }
    },

    onParse: function () {
        console.log("<?=$obj?>.onParse()");

        // reduce the input to an array of lines without font tags
        var lines = $(<?=$obj?>.input.content).val()
            .replace(/<font[^>]+>/g, "")
            .replace(/<\/font>/g, "")
            .replace(/(<br>)+/g, "\n")
            .split("\n");

        // parse lines
        var matches = [];
        for (l = 0; l < lines.length - 1; l++) {
            var hasChannel = lines[l].includes("joinChannel:player");
            var hasPass = lines[l + 1].toLowerCase().includes("password");
            if (hasChannel && hasPass) {
                var channel = lines[l].match(/<a [^>]+>([^<]+)/)[1];
                var password = lines[l + 1].trim().split(" ").pop();
                matches.push({ channel, password });
            }
        }

        // save in local storage
        <?=$obj?>.store("matches", matches);

        <?=$obj?>.show(matches);
    },

    onAdd: function() {
        var row = $(this).closest("tr");
        var channel = row.find("[name=channel]").val();
        var password = row.find("[name=password]").val();
        if (!channel || !password) {
            return;
        }
        <?=$obj?>.addTo("matches", {channel, password});
        <?=$obj?>.checkStorage();
    },

    show: function (matches, message = false) {
        // output
        $(<?=$obj?>.output.content).empty()
            .append(Mustache.render(
                $(<?=$obj?>.output.template).html(), { matches, message }
            ));

            // toggle view
        $(<?=$obj?>.input.ui).hide();
        $(<?=$obj?>.output.ui).show();
    },

    onDismiss: function () {
        // empty input
        $(<?=$obj?>.input.content).val("");

        // toggle view
        $(<?=$obj?>.input.ui).show();
        $(<?=$obj?>.output.ui).hide();
    },
    
    onCopy: function () {
        var password = $(this).closest("tr").find(".password").text();
        console.log("password is", password);
        site.copyToClipboard(password);
    },
    
    onSampleData: function () {
        $(<?=$obj?>.input.content).val(<?=$sampleData?>);
    }
};

$(<?=$obj?>.onDocumentReady);
