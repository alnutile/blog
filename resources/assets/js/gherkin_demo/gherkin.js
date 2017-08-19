var Gherkin = (function (register, undefined) {
    var eventStore = [],
        events = ['click'];

    var store = function (type, data) {
        eventStore.push({
            type: type,
            data: data
        });
    };

    events.forEach(function (event) {
        register(event, function (data) {
            store(event, data);
        }, false);
    });

    return {
        dump: function () {
          var converter = new EventsConverter();
          var results = converter.iterateOverEvents(eventStore);
          var finalOutput = converter.outputFeature(results);
          alert(finalOutput);

            console.log(eventStore);
        },

        store: function () {
            // do whatever you wanna do here…
        }
    };
})(document.addEventListener);

document.getElementById('btnDump').onclick = Gherkin.dump;
