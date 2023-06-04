

/* product left start */
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


  $(document).ready(function() {
    $('.select2').select2({
      tags: true,
      tokenSeparators: [',']
    }).on('change', function(e){
      let label = $(this).find("[data-select2-tag=true]");
      if(label.length && $.inArray(label.val(), $(this).val() !== -1)){
        $.ajax({
          url: "/tags/ajout/ajax/"+label.val(),
          type: "POST"
        }).done(function(data){
          label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`)
        })
      }
    });
   });


/***--------------------------------------------------------------- */




