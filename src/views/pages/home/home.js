console.log('>> HOME script is loaded.');
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

document.addEventListener('DOMContentLoaded', function () {

  // trends-section-tabs
  const tabButtons = document.querySelectorAll('.trends-section-tabs__pills .trends-section-tabs-btn');
  const tabContents = document.querySelectorAll('.trends-section-tabs__panels > div');

  if (tabButtons && tabContents) {
    tabButtons.forEach((tabBtn) => {
      tabBtn.addEventListener('click', () => {
        const tabId = tabBtn.getAttribute('data-id');

        tabButtons.forEach((btn) => btn.classList.remove('active'));
        tabBtn.classList.add('active');

        tabContents.forEach((content) => {
          content.classList.remove('active');

          if (content.id === tabId) {
            content.classList.add('active');
          }
        });
      });
    });
  }

  // propertiesSwiper
  const propertiesSwiperMobile = new Swiper('#propertiesSwiperMobile', {
    navigation: {
      nextEl: '#properties-swiper-button-next',
      prevEl: '#properties-swiper-button-prev',
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

  const propertiesSwiperDesktop = new Swiper('#propertiesSwiperDesktop', {
    effect: 'fade',
    freeMode: true,
    allowTouchMove: false,
    simulateTouch: false,
  });

  const paginationItems = document.querySelectorAll('.properties-pagination-item');

  paginationItems.forEach((item, index) => {
    item.addEventListener('click', () => {
      propertiesSwiperDesktop.slideTo(index);
      paginationItems.forEach((el) => el.classList.remove('active'));
      item.classList.add('active');
    });
  });

  // TrendsTabSwiper
  const firstTrendsTabSwiper = new Swiper('#firstTrendsTabSwiper', {
    navigation: {
      nextEl: '#hv-swiper-button-next',
      prevEl: '#hv-swiper-button-prev',
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

  const secondTrendsTabSwiperSwiper = new Swiper('#secondTrendsTabSwiper', {
    navigation: {
      nextEl: '#hv-swiper-button-next',
      prevEl: '#hv-swiper-button-prev',
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

  const thirdTrendsTabSwiper = new Swiper('#thirdTrendsTabSwiper', {
    navigation: {
      nextEl: '#hv-swiper-button-next',
      prevEl: '#hv-swiper-button-prev',
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
