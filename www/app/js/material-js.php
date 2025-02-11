<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/start.php";
$sampleDataPath = site()->getSampleDataPath("material.txt");
$sampleData = json_encode(file_get_contents($sampleDataPath));
$obj = "material";

?>

var <?=$obj?> = {
    input: {
        content: "#<?=$obj?>-input .content",
        ui: "#<?=$obj?>-input"
    },
    output: {
        content: "#<?=$obj?>-output .content",
        date: "#<?=$obj?> .date",
        table: {
            item: ".table-<?=$obj?> .item",
            totalPrice: ".table-<?=$obj?> .total .price"
        },
        template: "#<?=$obj?>",
        ui: "#<?=$obj?>-output"
    },

    onDocumentReady: function () {
        console.log("<?=$obj?>.onDocumentReady()");
        OnClick.install("<?=$obj?>"); // attaches click handlers
        $("body").on("change", "[data-<?=$obj?>onchange]", <?=$obj?>.onChange);
    },

    onAnalyze: function () {
        var input = $(<?=$obj?>.input.content).val();

        var parsed = <?=$obj?>.parse(input);
        var calculated = <?=$obj?>.calculate(parsed);
        var analyzed = <?=$obj?>.analyze(calculated);
        var formatted = <?=$obj?>.format(analyzed);

        // output
        $(<?=$obj?>.output.content).empty()
            .append(Mustache.render(
                $(<?=$obj?>.output.template).html(), { sections: formatted }
            ));
        
        // prepared
        $(<?=$obj?>.output.date).text(moment().format(site.dateFormat));

        // toggle view
        $(<?=$obj?>.input.ui).hide();
        $(<?=$obj?>.output.ui).show();
    },

    parse: function (input) {
        // split into an array of lines, filtering out empties
        var lines = input.split(/\r?\n/).filter(line => line.trim() != "");

        // group lines by section
        var parsed = [];
        for (var line of lines) {
            line = line.trim();
            var tabs = line.split("\t").length - 1;
            var current;
            var header;

            // add section every time a line has no tabs
            if (tabs == 0) {
                current = parsed.length;
                parsed.push({ name: line, data: [] });
                header = null;
                continue; // next line
            }

            // if there is no header, use this line
            if (tabs > 0 && header == null) {
                header = <?=$obj?>.parseLine(line);
                continue; // next line
            }

            // otherwise, it's data
            parsed[current].data.push(<?=$obj?>.parseLine(line, header));
        }

        return parsed;
    },

    parseLine: function (line, keys = null) {
        // split the line by tabs
        line = line.split("\t");

        if (keys != null) {
            var lineObj = {};
            for (var l = 0; l < line.length; l++) {
                lineObj[keys[l]] = line[l];
            }
            line = lineObj;
        }

        return line;
    },

    calculate: function (sections) {
        for (var s in sections) {
            for (var i in sections[s].data) {
                var item = sections[s].data[i];
                sections[s].data[i].Runs = item.Available / item.Required;
            }
        }

        return sections;
    },

    analyze: function (sections) {
        var least = null;
        var most = null;

        for (var s in sections) {
            for (var i in sections[s].data) {
                var item = sections[s].data[i];
                sections[s].data[i].classes = [];
                if (least == null || item.Runs < least.value) {
                    least = { s, i, value: item.Runs };
                }
                if (most == null || item.Runs > most.value) {
                    most = { s, i, value: item.Runs };
                }
            }
        }

        sections[least.s].data[least.i].classes.push("item-least-runs");
        sections[most.s].data[most.i].classes.push("item-most-runs");

        return sections;
    },

    format: function (sections) {
        for (var s in sections) {
            for (var i in sections[s].data) {
                var item = sections[s].data[i];
                sections[s].data[i].EstUnitPrice = item["Est. Unit price"];
                sections[s].data[i].FormattedRuns = Math.floor(item.Runs).toLocaleString();
                sections[s].data[i].FormattedAvailable = Number(item.Available).toLocaleString();
                sections[s].data[i].FormattedRequired = Number(item.Required).toLocaleString();
            }
        }

        sections[0].showCalculateFill = true;

        return sections;
    },

    onChange: function () {
        var target = $(this);
        var action = target.data("<?=$obj?>onchange");

        console.log("action is " + action);
        if (typeof <?=$obj?>[action] != "function") {
            console.error("Could not find method named " + action + ". Aborting.");
            return;
        }

        <?=$obj?>[action](target);
    },

    calculateFill: function (target) {
        const desiredruns = parseInt(target.val());

        // define formats
        const currency = {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        };
        const thousands = {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }

        let total = 0;
        $(<?=$obj?>.output.table.item).each(function (index, element) {
            const row = $(this);
            const price = parseFloat(row.find("[data-price]").data("price"));
            const required = parseFloat(row.find("[data-required]").data("required"));
            const available = parseFloat(row.find("[data-available]").data("available"));
            const runs = parseFloat(row.find("[data-runs]").data("runs"));

            const quantityCell = row.find(".quantity");
            const priceCell = row.find(".price");

            // empty everything
            quantityCell.text("");
            priceCell.text("");

            if (desiredruns > runs) {
                quantityNeeded = (desiredruns * required) - available;
                estimatedPrice = price * quantityNeeded;
                quantityCell.text(quantityNeeded.toLocaleString(undefined, thousands));
                priceCell.text(estimatedPrice.toLocaleString(undefined, currency));

                total += estimatedPrice;
            }
        });

        $(<?=$obj?>.output.table.totalPrice).text(total.toLocaleString(undefined, currency));
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
