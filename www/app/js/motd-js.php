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

    onSampleData: function () {
        $("#motdInput").val(<?=$sampleData?>);
        // $("#motdInput").val("[03:17:57] EVE System > Channel MOTD: <font size=\"14\" color=\"#bfffffff\"></font><font size=\"12\" color=\"#ffffffff\">.<br><br></font><font size=\"14\" color=\"#ffffffff\">This channel is not used. Please use the below channels:<br><br></font><font size=\"14\" color=\"#ff6868e1\"><a href=\"joinChannel:player_1262619e7bd511eb93929abe94f5a167\">Loose Coalition</a></font><font size=\"14\" color=\"#ffffffff\"> | for combined Coalition comms<br>Password: </font><font size=\"14\" color=\"#ffffff00\">arborealManapua_9599<br><br></font><font size=\"14\" color=\"#ff6868e1\"><a href=\"joinChannel:player_495464cfc22911efa27d00109bd0fca8\">Loose Ops</a></font><font size=\"14\" color=\"#ffffffff\"> | for combined ops with blues, allies, & friends of convenience<br>Password: </font><font size=\"14\" color=\"#ffffff00\">efervescentAnaconda_588<br><br></font><font size=\"14\" color=\"#ff6868e1\"><a href=\"joinChannel:player_297c0e4f6a8611eb95769abe94f5a43f\">Fast 'n' Loose</a></font><font size=\"14\" color=\"#ffffffff\"> | pub chat<br><br></font><font size=\"12\" color=\"#ffffffff\">ver. 2025.01.04<br><br>.</font>");
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
    }
};

$(motd.onDocumentReady);
