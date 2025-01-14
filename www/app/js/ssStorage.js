var ssStorage = {
    install: function (objName) {
        console.log("ssStorage.install(" + objName + ")");
        var target = window[objName];
        console.log(objName, target);

        // extend functionality into the target
        $.extend(target, {
            addTo: function(key, value) {
                var current = target.read(key);
                console.log("current", current);
                current.push(value);
                target.store(key, current);
            },

            clear: function(key) {
                localStorage.removeItem(target.key(key));
            },

            store: function (key, value) {
                localStorage.setItem(
                    target.key(key), JSON.stringify(value)
                );
            },

            read: function (key) {
                return JSON.parse(localStorage.getItem(
                    target.key(key)
                ));
            },

            key: function (key) {
                return objName + "_" + key;
            }
        });
    }
};
