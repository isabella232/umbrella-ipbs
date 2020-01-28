var timeOut = [];
var id = "";

function opacityToZero() {
    var cities = document.querySelectorAll('#cities > g');
    for (var i = 0; i < cities.length; i++) {
        var coverageGroups = cities[i].querySelectorAll('.coverage > g');
        var heading = cities[i].querySelector('.heading');
        var label = cities[i].querySelector('.label > g');
        jQuery.Velocity(heading, "stop");
        jQuery.Velocity(label, "stop");
        heading.style.opacity = 0;
        label.style.opacity = 1;
        for (var q = 0; q < coverageGroups.length; q++) {
            var circle = coverageGroups[q].querySelector('circle');
            var line = coverageGroups[q].querySelector('line');
            var text = coverageGroups[q].querySelector('text');
            if (circle) {
                jQuery.Velocity(circle, "stop");
                circle.style.opacity = 0;
            }
            if (line) {
                jQuery.Velocity(line, "stop");
                line.style.opacity = 0;
                line.setAttribute('stroke-dasharray', 1000);
            }
            if (text) {
                jQuery.Velocity(text, "stop");
                text.style.opacity = 0;
            }
        }
    }
}

function animateCity(id) {
    for (var x = 0; x < timeOut.length; x++) {
        clearTimeout(timeOut[x]);
    }
    opacityToZero();
    var clickedElement = document.getElementById(id);
    var heading = clickedElement.querySelector('.heading');
    var label = clickedElement.querySelector('.label > g');
    var coverageGroup = clickedElement.querySelectorAll('.coverage > g');
    jQuery.Velocity(heading, {opacity: 1}, {duration: 500, delay: 200});
    jQuery.Velocity(label, {opacity: 0}, {duration: 500, delay: 200});

    for (var w = 0; w < coverageGroup.length; w++) {
        (function (w) {
            timeOut[w] = setTimeout(function () {
                var circle = coverageGroup[w].querySelector('circle');
                var line = coverageGroup[w].querySelector('line');
                var text = coverageGroup[w].querySelector('text');
                if (circle) {
                    var radius = circle.getAttribute("r");
                    var opacity = circle.getAttribute("opacity");
                    circle.setAttribute("r", 0);
                    jQuery.Velocity(circle, {opacity: opacity}, 0);
                    jQuery.Velocity(circle, {r: radius}, {duration: 500, easing: "easeOutCirc"});
                }
                if (line) {
                    jQuery.Velocity(line, {opacity: opacity}, 0);
                    jQuery.Velocity(line, {'stroke-dashoffset': 500}, {duration: 0, delay: 0});
                    jQuery.Velocity(line, {'stroke-dashoffset': 0}, {duration: 500, delay: 100});
                }
                if (text) {
                    jQuery.Velocity(text, {opacity: 1}, {duration: 500, delay: 100,});
                }
            }, 500 * w);
        }(w));
    }
}

function animateClickedCity(cityID) {
    if (id !== cityID) {
        id = cityID;
        animateCity(id);
    }
}
