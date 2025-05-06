document.addEventListener('DOMContentLoaded', function() {
    start();
})

function start() {
    const sliders = document.querySelectorAll('.slider');
    if (sliders) {
        sliders.forEach(slider => {
            const options = {
                slidesPerView: 1,
                spaceBetween: 15,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 4
                    }
                }
            }
            const swiper = new Swiper(slider, options);
        });

    }
}