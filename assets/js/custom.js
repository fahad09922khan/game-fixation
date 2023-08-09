var swiper = new Swiper(".mainSlider .swiper", {
    speed: 600,
    parallax: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});

var reviewSlider = new Swiper(".reviewSlider", {
    slidesPerView: 3,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
});


Fancybox.bind("[data-fancybox]", {
    // Your custom options
});


AOS.init();