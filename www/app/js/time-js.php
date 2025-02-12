<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("time-station.txt");
$sampleData = json_encode(file_get_contents($sampleDataPath));
$obj = "time";

?>

var <?=$obj?> = {
    input: {
        station: "#stationTimer",
        bulk: "#bulk",
        simple: "#simple"
    },
    output: "#output",

    onDocumentReady: function () {
        console.log("<?=$obj?>.onDocumentReady()");
        OnClick.install("<?=$obj?>"); // attaches click handlers
    },

    convertStationTimer: function () {
        var patterns = ["YYYY.MM.DD", "HH:mm:SS"];
        var datetime = [];

        // get input
        var input = $(<?=$obj?>.input.station).val().trim();

        // split off chat log timestamp and character
        if (input.charAt(0) == "[") {
            var positionOfSplit = input.indexOf(" > ") + 3;
            input = input.substr(positionOfSplit);
        }

        // replace <br> with \n and split
        input = input.replaceAll("<br>", "\n").split(/\r?\n/);

        // extract system and station
        var firstline = input[0].split(" - ");
        var system = firstline[0];
        var station = firstline[1];
        var subject = station + " (in " + system + ")";

        input[2].split(" ").forEach(function (item) {
            if (moment(item, patterns).isValid()) {
                datetime.push(item);
            }
        });
        var eveTimestamp = moment.utc(datetime.join(" "), patterns.join(" ")).unix();

        // output eveTimestamp for additional use
        $(<?=$obj?>.output).val(eveTimestamp);

        // construct pieces for string
        var relative = <?=$obj?>.discordTag(eveTimestamp, "R");
        var fulldatetime = <?=$obj?>.discordTag(eveTimestamp, "F");

        // assemble and copy string
        site.copyToClipboard([subject, "timer expires", relative, "@", fulldatetime].join(" "));
    },

    convertBulk: function () {
        var input = $("#bulk").val().trim().split("\n");
        var patterns = ["YYYY.MM.DD", "HH:mm"];
        var output = [];

        // iterate through each line in the input
        input.forEach(line => {
            var datetime = [];
            var subject = [];
            // iterate through each item in the line
            line.split(" ").forEach(item => {
                if (moment(item, patterns).isValid()) {
                    datetime.push(item);
                } else {
                    subject.push(item);
                }
            });
            var eveTimestamp = moment.utc(datetime.join(" "), patterns.join(" ")).unix();

            // construct pieces for string
            var relative = <?=$obj?>.discordTag(eveTimestamp, "R");
            var fulldatetime = <?=$obj?>.discordTag(eveTimestamp, "F");

            // assemble string
            output.push([subject.join(" "), "expires", relative, "@", fulldatetime].join(" "));
        })

        // assemble and copy output
        site.copyToClipboard(output.join("\n"));
    },

    convertSimple: function () {
        var input = $(<?=$obj?>.input.simple).val();
        var inputMoment = moment(input);

        $(<?=$obj?>.output).val(inputMoment.unix());
    },

    discord: function () {
        var theTimestamp = $(<?=$obj?>.output).val();
        var format = $(this).find("code").text();
        var discordTag = <?=$obj?>.discordTag(theTimestamp, format);

        site.copyToClipboard(discordTag);
    },

    discordTag: function (theTimestamp, format) {
        // prepend : if not present
        if (format.substr(0, 1) != ":") {
            format = ":" + format;
        }

        return "<t:" + theTimestamp + format + ">";
    },

    stationTimerSampleData: function () {
        $(<?=$obj?>.input.station).val(<?=$sampleData?>);
    }
};

$(<?=$obj?>.onDocumentReady);
