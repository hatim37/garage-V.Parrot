

/* product left start *//*
if($(".product-left").length){
    var productSlider = new Swiper('.product-slider', {
      spaceBetween: 0,
      centeredSlides: false,
      loop:true,
      direction: 'horizontal',
      loopedSlides: 5,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      resizeObserver:true,
    });
    var productThumbs = new Swiper('.product-thumbs', {
      spaceBetween: 0,
      centeredSlides: true,
      loop: true,
      slideToClickedSlide: true,
      direction: 'horizontal',
      slidesPerView: 5,
      loopedSlides: 5,
    });
    productSlider.controller.control = productThumbs;
    productThumbs.controller.control = productSlider;
  }
  /*  product left end */




/***--------------------------------------------------------------- */
