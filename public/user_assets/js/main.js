let navbar = document.querySelector(".header .navbar");

document.querySelector("#menu-btn").onclick = () => {
    navbar.classList.toggle("active");
};

window.onscroll = () => {
    navbar.classList.remove("active");
};

var swiper = new Swiper(".home-slider", {
    spaceBetween: 5,
    centeredSlides: false,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },

        768: {
            slidesPerView: 1,
        },
        991: {
            slidesPerView: 1,
        },
    },
});

var swiperNotice = new Swiper(".notice-slider", {
    spaceBetween: 10,
    pagination: ".pagination",
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },

        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

$(".notice-slider").on("mouseenter", function (e) {
    swiperNotice.autoplay.stop();
});
$(".notice-slider").on("mouseleave", function (e) {
    swiperNotice.autoplay.start();
});

var swiperTeacher = new Swiper(".teachers-slider", {
    spaceBetween: 10,
    pagination: ".pagination",
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },

        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

$(".teachers-slider").on("mouseenter", function (e) {
    swiperTeacher.autoplay.stop();
});
$(".teachers-slider").on("mouseleave", function (e) {
    swiperTeacher.autoplay.start();
});

let accordion = document.querySelectorAll(
    ".faq .accordion-container .accordion"
);

accordion.forEach((acco) => {
    acco.onclick = () => {
        accordion.forEach((dion) => dion.classList.remove("active"));
        acco.classList.toggle("active");
    };
});
