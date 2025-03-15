        function rangeslide(value) {
            document.getElementById('rangeValue').innerHTML = value;
        }

        // nice selector

        let niceSelects = document.querySelectorAll(".nice-select")
        for (nice of niceSelects) {
        NiceSelect.bind(nice);
        }
// slider
        const swiper = new Swiper('.banner-swiper', {
    loop: true,
    autoplay: {
        delay: 3000,
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

// Pause on hover
document.querySelector('.banner-swiper').addEventListener('mouseenter', function() {
    swiper.autoplay.stop();
});

document.querySelector('.banner-swiper').addEventListener('mouseleave', function() {
    swiper.autoplay.start();
});


var mySwiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});

// Pause on hover
document.querySelector('.mySwiper').addEventListener('mouseenter', function() {
    mySwiper.autoplay.stop();
});

document.querySelector('.mySwiper').addEventListener('mouseleave', function() {
    mySwiper.autoplay.start();
});

        // product image slider
        const productSwiper = new Swiper('.productSwiper', {
            slidesPerView: '4',
            spaceBetween: 8,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });