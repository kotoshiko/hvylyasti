document.addEventListener("DOMContentLoaded", function () {
  // propertiesSwiper
  const propertiesSwiperMobile = new Swiper("#propertiesSwiperMobile", {
    navigation: {
      nextEl: "#properties-swiper-button-next",
      prevEl: "#properties-swiper-button-prev",
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      576: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });

  const propertiesSwiperDesktop = new Swiper("#propertiesSwiperDesktop", {
    effect: "fade",
    freeMode: true,
    allowTouchMove: false,
    simulateTouch: false,
  });

  const paginationItems = document.querySelectorAll(
    ".properties-pagination-item"
  );

  paginationItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      propertiesSwiperDesktop.slideTo(index);
      paginationItems.forEach((el) => el.classList.remove("active"));
      item.classList.add("active");
    });
  });

  // TrendsTabSwiper
  const firstTrendsTabSwiper = new Swiper("#firstTrendsTabSwiper", {
    navigation: {
      nextEl: "#hv-swiper-button-next",
      prevEl: "#hv-swiper-button-prev",
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  const secondTrendsTabSwiperSwiper = new Swiper("#secondTrendsTabSwiper", {
    navigation: {
      nextEl: "#hv-swiper-button-next",
      prevEl: "#hv-swiper-button-prev",
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  const thirdTrendsTabSwiper = new Swiper("#thirdTrendsTabSwiper", {
    navigation: {
      nextEl: "#hv-swiper-button-next",
      prevEl: "#hv-swiper-button-prev",
    },
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });
});
