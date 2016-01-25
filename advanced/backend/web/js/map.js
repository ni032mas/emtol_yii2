//document.addEventListener("DOMNodeInserted", function (event) {
//    if ($(event.target).parent()[0].className == "select2-selection__rendered") {
////        alert($(event.target).html());
//        $('#tagger').val(log("select2:select", 1));
//    }
//});
//
//var $eventLog = $(".js-event-log");
//var $eventSelect = $(".select2-selection__rendered");
//
//$eventSelect.on("select2:open", function (e) {
//    log("select2:open", e);
//});
//$eventSelect.on("select2:close", function (e) {
//    log("select2:close", e);
//});
//$eventSelect.on("select2:select", function (e) {
//    $('#tagger').val(454);
//    log("select2:select", e);
//});
//$eventSelect.on("select2:unselect", function (e) {
//    log("select2:unselect", e);
//});
//
//$eventSelect.on("change", function (e) {
//    log("change");
//});
//
//function log(name, evt) {
//    if (!evt) {
//        var args = "{}";
//    } else {
//        var args = JSON.stringify(evt.params, function (key, value) {
//            if (value && value.nodeName)
//                return "[DOM node]";
//            if (value instanceof $.Event)
//                return "[$.Event]";
//            return value;
//        });
//    }
//    var $e = $("<li>" + name + " -> " + args + "</li>");
//    $eventLog.append($e);
//    $e.animate({opacity: 1}, 10000, 'linear', function () {
//        $e.animate({opacity: 0}, 2000, 'linear', function () {
//            $e.remove();
//        });
//    });
//}

//Yandex map
ymaps.ready(init);

function init() {
    ecoordinate = $("#objreservation-coordinate").val() != "" ? JSON.parse("[" + $("#objreservation-coordinate").val() + "]") : [43.590074, 39.728182];
    var myPlacemark,
            myMap = new ymaps.Map('map', {
                center: ecoordinate,
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            });
    myPlacemark = createPlacemark(ecoordinate);
    myMap.geoObjects.add(myPlacemark);
    myPlacemark.events.add('dragend', function () {
        getAddress(myPlacemark.geometry.getCoordinates());
    });
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');

        // Если метка уже создана – просто передвигаем ее
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
//        else {
//            myPlacemark = createPlacemark(coords);
//            myMap.geoObjects.add(myPlacemark);
        // Слушаем событие окончания перетаскивания на метке.
//        }
        getAddress(coords);
        $("#objreservation-coordinate").val(coords);
//        $("#ecoordinate").val($("#objreservation-coordinate").val());
    });

    // Создание метки
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconContent: $("#objreservation-name").val()
        }, {
            preset: 'islands#violetStretchyIcon',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование)
    function getAddress(coords) {
        $("#objreservation-coordinate").val(coords);
        myPlacemark.properties.set({
            iconContent: $("#objreservation-name").val(),
            balloonContent: $("#objreservation-name").val()
        });
    }
}

