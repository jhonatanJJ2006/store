document.addEventListener("DOMContentLoaded", function() {
  // Swiper para el primer slider
  const slider1 = document.querySelector('.mySwiper');
  if (slider1) {
    var swiper1 = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }

  
});