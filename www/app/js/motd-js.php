<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("motd.txt");
$sampleData = json_encode(file_get_contents($sampleDataPath));

?>

var motd = {
    onDocumentReady: function () {
        console.log("motd.onDocumentReady()");
        OnClick.install("motd"); // attaches click handlers
        ssStorage.install("motd");
        motd.checkStorage();
    },

    checkStorage: function() {
        var matches = motd.read("matches");
        if (matches) {
            const msg = "Found these entries from before.";
            motd.show(matches, msg);
        }
    },

    onParse: function () {
        console.log("motd.onParse()");

        // reduce the input to an array of lines without font tags
        var lines = $("#motdInput").val()
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
        motd.store("matches", matches);

        motd.show(matches);
    },

    onAdd: function() {
        var row = $(this).closest("tr");
        var channel = row.find("[name=channel]").val();
        var password = row.find("[name=password]").val();
        if (!channel || !password) {
            return;
        }
        motd.addTo("matches", {channel, password});
        motd.checkStorage();
    },

    show: function (matches, message = false) {
        // output
        $("#motd-output .result").empty()
            .append(Mustache.render(
                $("#motd-result").html(), { matches, message }
            ));

        // toggle view
        $("#motd-ui").hide();
        $("#motd-output").show();
    },

    onDismiss: function () {
        // empty input
        $("#motdInput").val("");
        
        // toggle view
        $("#motd-ui").show();
        $("#motd-output").hide();
    },
    
    onCopy: function () {
        var password = $(this).closest("tr").find(".password").text();
        console.log("password is", password);
        site.copyToClipboard(password);
    },
    
    onSampleData: function () {
        $("#motdInput").val(<?=$sampleData?>);
    }
};

$(motd.onDocumentReady);
