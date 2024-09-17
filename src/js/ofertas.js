(function() {
    const slider = document.querySelector('.slides-of');
    const slides = document.querySelectorAll('.slide-of');
    let currentIndex = 0;

    if(slider) {

        function nextSlide() {
            currentIndex++;
            if (currentIndex >= slides.length) {
                currentIndex = 0;
            }
            updateSlider();
        }
    
        function updateSlider() {
            const offset = -currentIndex * 100;
            slider.style.transform = `translateX(${offset}%)`;
        }
    
        setInterval(nextSlide, 2000);

    }

})();
