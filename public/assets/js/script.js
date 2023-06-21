

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


window.onload = () => {
  // On va chercher toutes les étoiles
  const stars = document.querySelectorAll(".la-star");
  
  // On va chercher l'input
  const note = document.querySelector("#comment_note");

  // On boucle sur les étoiles pour le ajouter des écouteurs d'évènements
  for(star of stars){
      // On écoute le survol
      star.addEventListener("mouseover", function(){
          resetStars();
          this.style.color = "#ffbe00";
          this.classList.add("las");
          this.classList.remove("lar");
          // L'élément précédent dans le DOM (de même niveau, balise soeur)
          let previousStar = this.previousElementSibling;

          while(previousStar){
              // On passe l'étoile qui précède en rouge
              previousStar.style.color = "#ffbe00";
              previousStar.classList.add("las");
              previousStar.classList.remove("lar");
              // On récupère l'étoile qui la précède
              previousStar = previousStar.previousElementSibling;
          }
      });

      // On écoute le clic
      star.addEventListener("click", function(){
          note.value = this.dataset.value;
      });

      star.addEventListener("mouseout", function(){
          resetStars(note.value);
      });
  }

  /**
   * Reset des étoiles en vérifiant la note dans l'input caché
   * @param {number} note 
   */
  function resetStars(note = 0){
      for(star of stars){
          if(star.dataset.value > note){
              star.style.color = "black";
              star.classList.add("lar");
              star.classList.remove("las");
          }else{
              star.style.color = "#ffbe00";
              star.classList.add("las");
              star.classList.remove("lar");
          }
      }
  }
}

