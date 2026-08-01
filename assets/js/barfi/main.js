/***************************************************
==================== JS INDEX ======================
****************************************************
01. text scroll animation
02. back-to-top
03. stiky js
04. mobile menu js
05. popup image 
06. popup video 
07. nice select
08. preloader
09. Counter js
10. jarallax



****************************************************/



    /* ================================
        Mouse Cursor Animation Js Start
    ================================ */
	
	if ($(".mouseCursor").length > 0) {
        function itCursor() {
            var myCursor = jQuery(".mouseCursor");
            if (myCursor.length) {
                if ($("body")) {
                    const e = document.querySelector(".cursor-inner"),
                        t = document.querySelector(".cursor-outer");
                    let n, i = 0, o = !1;
                    window.onmousemove = function(s) {
                        if (!o) {
                            t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)";
                        }
                        e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)";
                        n = s.clientY;
                        i = s.clientX;
                    };
                    $("body").on("mouseenter", "button, a, .cursor-pointer", function() {
                        e.classList.add("cursor-hover");
                        t.classList.add("cursor-hover");
                    });
                    $("body").on("mouseleave", "button, a, .cursor-pointer", function() {
                        if (!($(this).is("a", "button") && $(this).closest(".cursor-pointer").length)) {
                            e.classList.remove("cursor-hover");
                            t.classList.remove("cursor-hover");
                        }
                    });
                    e.style.visibility = "visible";
                    t.style.visibility = "visible";
                }
            }
        }
        itCursor();
    }


AOS.init({
	duration:1000,
	once: true,
});


(function($){
    "use strict";
    
/*----------------------------------------*/
/*  02. back-to-top
/*----------------------------------------*/
    var progressPath = document.querySelector(".progress-wrap path");
    if (progressPath) {
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition =
          "none";
        progressPath.style.strokeDasharray = pathLength + " " + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition =
          "stroke-dashoffset 10ms linear";
        var updateProgress = function () {
          var scroll = $(window).scrollTop();
          var height = $(document).height() - $(window).height();
          var progress = pathLength - (scroll * pathLength) / height;
          progressPath.style.strokeDashoffset = progress;
        };
        updateProgress();
        $(window).scroll(updateProgress);
    }
    var offset = 50;
    var duration = 550;
    jQuery(window).on("scroll", function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery(".progress-wrap").addClass("active-progress");
      } else {
        jQuery(".progress-wrap").removeClass("active-progress");
      }
    });
    jQuery(".progress-wrap").on("click", function (event) {
      event.preventDefault();
      jQuery("html, body").animate({ scrollTop: 0 }, duration);
      return false;
    });
     


	
/*----------------------------------------*/
/*  03. stiky js
/*----------------------------------------*/
    var windowOn = $(window);
    windowOn.on('scroll', function () {
      var scroll = windowOn.scrollTop();
      if (scroll < 100) {
        $("#vl-header-sticky").removeClass("header-sticky");
      } else {
        $("#vl-header-sticky").addClass("header-sticky");
      }
    });


	
    
/*----------------------------------------*/
/*  04. mobile menu js
/*----------------------------------------*/
        var vlSideMenu = $('.vl-offcanvas-menu nav');
        // Only clone menu if nav is empty (to prevent duplication)
        if (vlSideMenu.find('ul').length === 0) {
            var vlMenuWrap = $('.vl-mobile-menu-active > ul').clone();
            vlSideMenu.append(vlMenuWrap);
        }
        if ($(vlSideMenu).find('.sub-menu, .vl-mega-menu').length != 0) {
          $(vlSideMenu).find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>');
        }
    
        var sideMenuList = $('.vl-offcanvas-menu nav > ul > li button.vl-menu-close, .vl-offcanvas-menu nav > ul li.has-dropdown > a');
        $(sideMenuList).on('click', function (e) {
          console.log(e);
          e.preventDefault();
          if (!($(this).parent().hasClass('active'))) {
            $(this).parent().addClass('active');
            $(this).siblings('.sub-menu, .vl-mega-menu').slideDown();
          } else {
            $(this).siblings('.sub-menu, .vl-mega-menu').slideUp();
            $(this).parent().removeClass('active');
          }
        });


    $(".vl-offcanvas-toggle").on('click',function(){
        $(".vl-offcanvas").addClass("vl-offcanvas-open");
        $(".vl-offcanvas-overlay").addClass("vl-offcanvas-overlay-open");
    });

    $(".vl-offcanvas-close-toggle,.vl-offcanvas-overlay").on('click', function(){
        $(".vl-offcanvas").removeClass("vl-offcanvas-open");
        $(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
    });


	

/*----------------------------------------*/
/*  05. popup image 
/*----------------------------------------*/
    $('.popup-image').magnificPopup({
        type: 'image'
    });

/*----------------------------------------*/
/*  06. popup video 
/*----------------------------------------*/
	$('.popup-video').magnificPopup({
		type: 'iframe'
	});

/*----------------------------------------*/
/*  07. nice select
/*----------------------------------------*/
	$('select').niceSelect();

/*----------------------------------------*/
/*  09. Counter js
/*----------------------------------------*/

	// Wait 2 seconds, then start counting
	setTimeout(function() {
		var el = document.getElementById("myOdometer");
		if (el) el.innerHTML = 500;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer1");
		if (el) el.innerHTML = 99;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer2");
		if (el) el.innerHTML = 12;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer3");
		if (el) el.innerHTML = 13;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer4");
		if (el) el.innerHTML = 1500;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer5");
		if (el) el.innerHTML = 700;
	}, 2000);

	setTimeout(function() {
		var el = document.getElementById("myOdometer6");
		if (el) el.innerHTML = 13;
	}, 2000);


/*----------------------------------------*/
/*  08. preloader
/*----------------------------------------*/
	$(window).on("load", function (event) {
        setTimeout(function () {
          $(".preloader").fadeToggle();
        }, 200);
	});

	



/*----------------------------------------*/
/*  10. jarallax
/*----------------------------------------*/
  if($('.jarallax').length){
    $('.jarallax').jarallax({
      speed: 0.2,
    });
  }



	// data-bg
	$("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
  	})


// Reveal animation //
	const hoverItem = document.querySelectorAll(".hover-reveal-item");
	function moveImage(e, hoverItem) {
		const item = hoverItem.getBoundingClientRect();
		const x = e.clientX - item.x;
		const y = e.clientY - item.y;
		if (hoverItem.children[1]) {
			hoverItem.children[1].style.transform = `translate(${x}px, ${y}px)`;
		}
	}
	hoverItem.forEach((item, i) => {
		item.addEventListener("mousemove", (e) => {
			setInterval(moveImage(e, item), 100);
		});
	});



	



})(jQuery);


/*----------------------------------------*/
/*  01.text scroll animation
/*----------------------------------------*/

function initHeadingAnimation() {
		
		if($('.text-effect').length) {
			var textheading = $(".text-effect");

			if(textheading.length === 0) return; gsap.registerPlugin(SplitText); textheading.each(function(index, el) {
				
				el.split = new SplitText(el, { 
					type: "lines,words,chars",
					linesClass: "split-line"
				});
				
				if( $(el).hasClass('text-effect') ){
					gsap.set(el.split.chars, {
						opacity: .3,
						x: "-7",
					});
				}
				el.anim = gsap.to(el.split.chars, {
					scrollTrigger: {
						trigger: el,
						start: "top 92%",
						end: "top 60%",
						markers: false,
						scrub: 1,
					},

					x: "0",
					y: "0",
					opacity: 1,
					duration: .7,
					stagger: 0.2,
				});
				
			});
		}
		
		if ($('.text-anime-style-1').length) {
			let staggerAmount 	= 0.05,
				translateXValue = 0,
				delayValue 		= 0.5,
			   animatedTextElements = document.querySelectorAll('.text-anime-style-1');
			
			animatedTextElements.forEach((element) => {
				let animationSplitText = new SplitText(element, { type: "chars, words" });
					gsap.from(animationSplitText.words, {
					duration: 1,
					delay: delayValue,
					x: 20,
					autoAlpha: 0,
					stagger: staggerAmount,
					scrollTrigger: { trigger: element, start: "top 85%" },
					});
			});		
		}
		
		if ($('.text-anime-style-2').length) {				
			let	 staggerAmount 		= 0.03,
				 translateXValue	= 20,
				 delayValue 		= 0.1,
				 easeType 			= "power2.out",
				 animatedTextElements = document.querySelectorAll('.text-anime-style-2');
			
			animatedTextElements.forEach((element) => {
				let animationSplitText = new SplitText(element, { type: "chars, words" });
					gsap.from(animationSplitText.chars, {
						duration: 1,
						delay: delayValue,
						x: translateXValue,
						autoAlpha: 0,
						stagger: staggerAmount,
						ease: easeType,
						scrollTrigger: { trigger: element, start: "top 85%"},
					});
			});		
		}
		
		if ($('.text-anime-style-3').length) {		
			let	animatedTextElements = document.querySelectorAll('.text-anime-style-3');
			
			 animatedTextElements.forEach((element) => {
				//Reset if needed
				if (element.animation) {
					element.animation.progress(1).kill();
					element.split.revert();
				}

				element.split = new SplitText(element, {
					type: "lines,words,chars",
					linesClass: "split-line",
				});
				gsap.set(element, { perspective: 400 });

				gsap.set(element.split.chars, {
					opacity: 0,
					x: "50",
				});

				element.animation = gsap.to(element.split.chars, {
					scrollTrigger: { trigger: element,	start: "top 90%" },
					x: "0",
					y: "0",
					rotateX: "0",
					opacity: 1,
					duration: 1,
					ease: Back.easeOut,
					stagger: 0.02,
				});
			});		
		}
	}
	
	if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            initHeadingAnimation();
        });
    } else {
        window.addEventListener("load", initHeadingAnimation);
    }


/* ================================
	Smooth Scroller And Title Animation Js Start
================================ */
    // if ($('#smooth-wrapper').length && $('#smooth-content').length) {
    //     gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

    //     gsap.config({
    //         nullTargetWarn: false,  
    //     });

    //     let smoother = ScrollSmoother.create({
    //         wrapper: "#smooth-wrapper",
    //         content: "#smooth-content",
    //         smooth: 2,
    //         effects: true,
    //         smoothTouch: 0.1,
    //         normalizeScroll: false,
    //         ignoreMobileResize: true,
    //     });
    // }
