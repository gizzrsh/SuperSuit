const btnOpenRentPopup = document.querySelector('.product__btn');
const btnOpenAuthPopup = document.querySelector('.header__btn');
const btnOpenRegisterPopup = document.querySelector('.register-link');
const btnCloseRentPopup = document.querySelector('.popup__close-rent');
const btnCloseAuthPopup = document.querySelector('.popup__close-auth');
const popupRent = document.getElementById('popup-rent');
const popupAuth = document.getElementById('popup-auth');

if (btnOpenRentPopup && btnCloseRentPopup) {
  btnOpenRentPopup.addEventListener('click', () => {
    popupRent.style.display = 'flex';
  });
  btnCloseRentPopup.addEventListener('click', () => {
    popupRent.style.display = 'none';
  });
}

if (btnOpenAuthPopup && btnCloseAuthPopup) {
  btnOpenAuthPopup.addEventListener('click', () => {
    popupAuth.style.display = 'flex';
  });
  btnCloseAuthPopup.addEventListener('click', () => {
    popupAuth.style.display = 'none';
  });
}











































// swiper js
const swiper = new Swiper(".mySwiper", {
  loop: true,
  breakpoint: {
    320: {
      slidesPerView: 5,
      centeredSlides: true,
    },
  }
});

const swiper2 = new Swiper(".mySwiper2", {
  direction: 'horizontal',
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 10,
  loop: false,
  centeredSlides: true,
  speed: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

// swiper modal - fullscreen
const swiperModal = new Swiper(".swiperModal", {  
  loop: true,
  breakpoint: {
    640: {
      slidesPerView: 5,
      centeredSlides: true,
    },
  }
});

const swiperModal2 = new Swiper(".swiperModal2", {
  loop: true,
  crossFade: true,
  speed: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: { 
    swiper: swiperModal,
  },
});

const mySwiper2 = document.querySelector('.mySwiper2 > .swiper-wrapper');
const modalClose = document.querySelector('.modal__close');
const modalSwiper = document.querySelector('.product__swiper-fullscreen');

if (mySwiper2 && modalClose && modalSwiper) {
  mySwiper2.addEventListener('click', () => {
    modalSwiper.style.display = "flex";
    // document.body.style.overflow = "hidden";
  })
  modalClose.addEventListener('click', () => {
    modalSwiper.style.display = "none";
    document.body.style.overflow = "";
  });
}