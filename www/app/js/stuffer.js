var stuffer = {
    onDocumentReady: function () {
        console.log("stuffer.onDocumentReady()");
        OnClick.install("stuffer"); // attaches click handlers
        $("body").on("change", "[data-stufferonchange]", stuffer.onChange);
    },

    onChange: function () {
        var target = $(this);
        var action = target.data("stufferonchange");

        console.log("action is " + action);
        if (typeof stuffer[action] != "function") {
            console.error("Could not find method named " + action + ". Aborting.");
            return;
        }

        stuffer[action](target);
    }
};

$(stuffer.onDocumentReady);
