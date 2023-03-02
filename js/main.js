(function ($) {
    const siteHeader = document.querySelector(".site-header");
  if (siteHeader) {
    const headroom = new Headroom(siteHeader);
    headroom.init();
  }
  
  // const searchPopup = document.querySelector(".search-pop-up");
  
  // const closeSearch = searchPopup.querySelector(".close-search");
  const searchPopupBtn = document.querySelector(".search-btn");
  const searchPopup = document.querySelector(".search-pop-up");
  const searchClose = document.querySelector(".close-search");
  console.log('btn ',searchPopupBtn);
  searchPopupBtn.addEventListener("click", () => {
    // searchPopup.style.display = 'flex';
    searchPopup.classList.add('search-open');
    document.querySelector('.search-field').focus();
  });

  searchClose.addEventListener("click", () => {
    searchPopup.classList.remove('search-open');
  });

 

  // const siteLogo = $('.site-logo').attr('src');
  // const whiteSiteLogo = siteLogo.replace('green', 'white');
  
  if ($(".megahero").length && !$(".megahero").hasClass('below-header')) {
    // $('.site-logo').attr('src', whiteSiteLogo);
    $('body').addClass('body-mega-hero has-hero');
  }

  const megaHeroFunction = function(direction) {
    const body = $('body');
    if (direction == 'up') {
      body.addClass('body-mega-hero');
      // $('.site-logo').attr('src', whiteSiteLogo);
    } else {
      body.removeClass('body-mega-hero');
      // $('.site-logo').attr('src', siteLogo);
    }
  }


  const megaHero = $(".megahero:not(.below-header)").waypoint({
    // handler: megaHeroFunction(direction),
    handler: function(direction){
      megaHeroFunction(direction);
    },
    offset: function() {
      return -this.element.clientHeight
    }
  });




})(jQuery);