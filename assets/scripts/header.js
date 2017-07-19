function startAnimation() {
    var current = 0;
    var slides = document.querySelectorAll(".bg_slider li");
    slides[current].style.opacity = 1;
    animateHeader(current, slides);
}

function animateHeader(current, slides) {
    setInterval(function() {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.opacity = 0;
        }
        current = (current != slides.length - 1) ? current + 1 : 0;
        slides[current].style.opacity = 1;
    }, 4000);
}

window.onload=function() {
    startAnimation();
};