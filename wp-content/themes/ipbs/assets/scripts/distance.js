/**
 * Created by admin on 2/3/16.
 */


(function ($) {

    var userLat;
    var userLon;

    function insertStationList() {
        for (var i = 0; i < cities.length; i++) {
            var city = cities[i];
            var listString = "<div class=\"region\" id> <h2>" + city.name + " <img class=\"rotate\" src=\"" + caret_url + "\"></h2>";
            listString = listString + "<ul class=\"stations\">";

            if (city.TVStations.length > 0) {
                for (var t = 0; t < city.TVStations.length; t++) {
                    var station = city.TVStations[t];
                    //console.log(station);
                    if (station.link) {
                        listString = listString + "<li class=\"tv\"><a target=\"_blank\" href=\"" + station.link + "\">" + station.post_title + "</a></li>";
                    } else {
                        listString = listString + "<li class=\"tv\">" + station.post_title + "</li>";
                    }
                }
            }

            if (city.radioStations.length > 0) {
                for (var r = 0; r < city.radioStations.length; r++) {
                    station = city.radioStations[r];
                    if (station.link) {
                        listString = listString + "<li class=\"radio\"><a target=\"_blank\" href=\"" + station.link + "\">" + station.post_title + "</a></li>";
                    } else {
                        listString = listString + "<li class=\"radio\">" + station.post_title + "</li>";
                    }
                }
            }

            listString = listString + "</ul>";

            $(".rightcolumn").append(listString + "</div>");
        }
        $('.region ul').hide();

        $('.region h2').first().trigger('click');
    }

    function toRadians(n) {
        return n * Math.PI / 180;
    }

    function distanceFromUser(lat, lon) {

        var R = 6371000; // metres
        var φ1 = toRadians(lat);
        var φ2 = toRadians(userLat);
        var Δφ = toRadians((userLat - lat));
        var Δλ = toRadians((userLon - lon));

        var a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c;
    }

    function swapCities(j, k) {
        var temp = cities[j];
        cities[j] = cities[k];
        cities[k] = temp;
    }

    function distance() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(currentPosition, function () {
                insertStationList();
            });
        }
    }

    function currentPosition(position) {
        userLat = position.coords.latitude;
        userLon = position.coords.longitude;

        for (i = 0; i < cities.length; i++) {
            var city = cities[i];
            city["distance"] = distanceFromUser(city["lat"], city["lon"]);
        }

        for (j = 0; j < cities.length; j++) {
            for (k = j + 1; k < cities.length; k++) {
                var outer = cities[j];
                var inner = cities[k];
                if (outer["distance"] > inner["distance"]) {
                    swapCities(j, k);
                }
            }
        }
        insertStationList();
    }

    distance();

})(jQuery);


