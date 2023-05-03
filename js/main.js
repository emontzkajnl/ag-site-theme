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
      return -this.element.clientHeight+100;
    }
  });

  
  $('#load-more-cats').on('click', function() {
    const btn = $(this);
    let paged = btn.data('paged');
    const data = {
      action: "loadMoreCats",
      cat: btn.data('cat'),
      page: paged++,
      url: '/wp-admin/admin-ajax.php'
    }
    console.dir(data);
    $.ajax({
      type: 'POST',
      data: data,
      dataType: 'html',
      success: function(res){
        if (res) {
          // console.dir(res);
          $('.alm-container').append(res);
        } else {
          // console.log('no res');
        }
        
      }
    });
  });


})(jQuery);