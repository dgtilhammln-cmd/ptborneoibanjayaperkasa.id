/***************************************************
==================== JS INDEX ======================
****************************************************
01. Banner Slider (Home One)
02. Testimonial Slider (Home One)
03. Blog Slider (Home One)
04. Solutation Slider (Home Two)
05. Team Slider (Home Three)
06. Banner Slider (Home Three)
07. Brand Active (Home Four)
08. Service Slider (Home Four)
09. Team Slider (Home Four)
10. Service Slider (Home Five)
11. Testimonial Slider (Home Three)
13. Testimonial Slider (Home Six)
14. Thumb Slider (Home Six)
15. Choose Box Slider (Home Six)
16. Service Slider (Home Seven)
17. testimonial Slider (Home Seven)
18. Banner Slider (Home nine)

****************************************************/




(function ($) {
    "use strict";

/*----------------------------------------*/
/*  01. Banner Slider (Home One)
/*----------------------------------------*/

	var swiper = new Swiper(".mySwiper2", {
		loop: true,
		spaceBetween: 20,
		slidesPerView: 3,
		freeMode: true,
		watchSlidesProgress: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
    });
    var swiper2 = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
	  effect: 'fade',
      navigation: {
        nextEl: ".vl-swiper-button-next",
        prevEl: ".vl-swiper-button-prev",
      },
	  	autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
      thumbs: {
        swiper: swiper,
      },
    });
 
/*----------------------------------------*/
/*  02. Testimonial Slider (Home One)
/*----------------------------------------*/

if ($('.vlTestActive').length) {
    const vlTestActive = new Swiper('.vlTestActive', {
        slidesPerView: 4,
        spaceBetween: 30,
		loop:true,
        speed: 4000,
        keyboard: {
            enabled: true,
        },
		autoplay: {
            delay: 1,
            disableOnInteraction: true,
          },
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}

/*----------------------------------------*/
/*  03. Blog Slider (Home One)
/*----------------------------------------*/

if ($('.blogSwiper').length) {
    const blogSwiper = new Swiper('.blogSwiper', {
        slidesPerView: 3,
        spaceBetween: 30,
		loop:true,
      autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		navigation: {
        	nextEl: ".vl-blog-swiper-button-next",
        	prevEl: ".vl-blog-swiper-button-prev",
      	},
		breakpoints: {
            0: {
            slidesPerView: 1,
            },
            768: {
            slidesPerView: 2,
            },
            992: {
            slidesPerView: 3,
            },
            1200: {
            slidesPerView: 3,
            }
        },
    });
}

/*----------------------------------------*/
/*  04. Solutation Slider (Home Two)
/*----------------------------------------*/

if ($('.vlTestActive2').length) {
    const vlTestActive2 = new Swiper('.vlTestActive2', {
        slidesPerView: 4,
        spaceBetween: 30,
		loop:true,
        keyboard: {
            enabled: true,
        },
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}

/*----------------------------------------*/
/*  05. Team Slider (Home Three)
/*----------------------------------------*/

if ($('.vlTeamActive3').length) {
    const vlTeamActive3 = new Swiper('.vlTeamActive3', {
        slidesPerView: 4,
        spaceBetween: 30,
		loop:true,
        keyboard: {
            enabled: true,
        },
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
      navigation: {
          nextEl: ".vl-review-button-next",
          prevEl: ".vl-review-button-prev",
      },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
  });
}


/*----------------------------------------*/
/*  06. Banner Slider (Home Three)
/*----------------------------------------*/

if ($('.mtySwiper').length) {
    const mtySwiper = new Swiper('.mtySwiper', {
      spaceBetween: 30,
      centeredSlides: true,
      loop:true,
      effect: 'fade',
      // autoplay: {
      //   delay: 3500,
      //   disableOnInteraction: false,
      // },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
  });
}

/*----------------------------------------*/
/*  07. Brand Active (Home Four)
/*----------------------------------------*/
    var swiper = new Swiper(".vl-brand-top-active", {
        slidesPerView: 'auto',
        spaceBetween: 80,
        freemode: true,
        centeredSlides: true,
        loop: true,
        speed: 4000,
        allowTouchMove: false,
        autoplay: {
            delay: 1,
            disableOnInteraction: true,
          },
    });


/*----------------------------------------*/
/*  08. Service Slider (Home Four)
/*----------------------------------------*/

if ($('.vlServiceActive4').length) {
    const vlServiceActive4 = new Swiper('.vlServiceActive4', {
        slidesPerView: 4,
        spaceBetween: 30,
		    loop:true,
        keyboard: {
          enabled: true,
        },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}

/*----------------------------------------*/
/*  09. Team Slider (Home Four)
/*----------------------------------------*/

if ($('.vlTeamActive4').length) {
    const vlTeamActive4 = new Swiper('.vlTeamActive4', {
      slidesPerView: 4,
      spaceBetween: 30,
		  loop:true,
        keyboard: {
            enabled: true,
        },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".vl-review-button-next",
          prevEl: ".vl-review-button-prev",
      },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}

/*----------------------------------------*/
/*  10. Service Slider (Home Five)
/*----------------------------------------*/

if ($('.vlServiceActive5').length) {
    const vlServiceActive5 = new Swiper('.vlServiceActive5', {
        slidesPerView: 4,
        spaceBetween: 30,
        loop:true,
        keyboard: {
            enabled: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}

var swiper = new Swiper(".marquee-swiper", {
      slidesPerView: 5,
      spaceBetween: 30,
      loop: true,
      speed: 6000,
      allowTouchMove: false,
      autoplay: {
        delay: 1,
        disableOnInteraction: false
      },
      breakpoints: {
            0: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 1,
            },
            992: {
              slidesPerView: 1,
            },
            1200: {
              slidesPerView: 1,
            }
        },
    });

/*----------------------------------------*/
/*  11. Testimonial Slider (Home Three)
/*----------------------------------------*/
if ($('.testimonialActive3').length) {
    const testimonialActive3 = new Swiper('.testimonialActive3', {
        slidesPerView: 5,
        spaceBetween: 30,
        loop: true,
        speed: 6000,
        allowTouchMove: false,
        autoplay: {
          delay: 1,
          disableOnInteraction: false
        },
        
        breakpoints: {
            0: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 1,
            },
            992: {
              slidesPerView: 1,
            },
            1200: {
              slidesPerView: 1,
            }
        },
    });
}

/*----------------------------------------*/
/*  12. Testimonial Slider (Home Five)
/*----------------------------------------*/

if ($('.vlTestimonialActive5').length) {
    const vlTestimonialActive5 = new Swiper('.vlTestimonialActive5', {
        slidesPerView: 4,
        spaceBetween: 30,
        loop:true,
        keyboard: {
            enabled: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 2,
          },
          1200: {
            slidesPerView: 3,
          }
      },
    });
}



/*----------------------------------------*/
/*  13. Testimonial Slider (Home Six)
/*----------------------------------------*/

if ($('.vlTestActive6').length) {
    const vlTestActive6 = new Swiper('.vlTestActive6', {
        slidesPerView: 4,
        spaceBetween: 30,
		    loop:true,
          keyboard: {
              enabled: true,
          },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".vl-review-button-next",
            prevEl: ".vl-review-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}


/*----------------------------------------*/
/*  14. Thumb Slider (Home Six)
/*----------------------------------------*/

if ($('.vlSmthumbActive6').length) {
    const vlSmthumbActive6 = new Swiper('.vlSmthumbActive6', {
      slidesPerView: 4,
      spaceBetween: 30,
		  loop:true,
        keyboard: {
            enabled: true,
        },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".vl-review-button-next",
          prevEl: ".vl-review-button-prev",
      },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 3,
          }
      },
    });
}


/*----------------------------------------*/
/*  15. Choose Box Slider (Home Six)
/*----------------------------------------*/

if ($('.chooseActive6').length) {
    const chooseActive6 = new Swiper('.chooseActive6', {
      cssMode: true,
      loop:true,
        navigation: {
          nextEl: ".vl-ch-button-prev",
          prevEl: ".vl-ch-button-next",
        },
        autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
      pagination: {
        el: ".swiper-pagination",
      },
    });
}

/*----------------------------------------*/
/*  16. Service Slider (Home Seven)
/*----------------------------------------*/

if ($('.vlServiceActive7').length) {
    const vlServiceActive7 = new Swiper('.vlServiceActive7', {
        slidesPerView: 4,
        spaceBetween: 30,
        loop:true,
          keyboard: {
              enabled: true,
          },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".vl-review-button-next",
          prevEl: ".vl-review-button-prev",
      },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          }
      },
    });
}


/*----------------------------------------*/
/*  17. testimonial Slider (Home Seven)
/*----------------------------------------*/

if ($('.testimonial7').length) {
  const testimonial7 = new Swiper('.testimonial7', {
      spaceBetween: 30,
      loop:true,
      keyboard: {
          enabled: true,
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".vl-test-button-next7",
          prevEl: ".vl-test-button-prev7",
      },
  });
}


/*----------------------------------------*/
/*  18. Banner Slider (Home nine)
/*----------------------------------------*/
if ($('.mtySwiper9').length) {
    const mtySwiper9 = new Swiper('.mtySwiper9', {
      spaceBetween: 30,
      centeredSlides: true,
      loop:true,
      effect: 'fade',
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".vl-sllide-button-prev",
          prevEl: ".vl-sllide-button-next",
      },
  });
}


// banner slider 5 

var swiper = new Swiper(".mySwiperthumb", {
      loop: true,
      spaceBetween: 30,
      slidesPerView: 3,
      freeMode: true,
      watchSlidesProgress: true,
    });
  var swiper2 = new Swiper(".mySwiper3", {
      loop: true,
      effect: "fade",
      spaceBetween: 10,
      thumbs: {
        swiper: swiper,
      },
  });


  // testimonial active 4 

  var swiper = new Swiper(".testimonial4", {
      pagination: {
        el: ".swiper-pagination",
        type: "fraction",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });




})(jQuery);