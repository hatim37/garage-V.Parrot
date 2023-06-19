//testimonial slider
$('.testimonials').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    speed: 800,
    dots:true,
    centerMode: true,
    centerPadding: '0px',
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          arrows:false
        }
      }
      
    ]
  });