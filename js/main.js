(function ($) {
    const siteHeader = document.querySelector(".site-header");
  if (siteHeader) {
    const headroom = new Headroom(siteHeader);
    headroom.init();
  }
  
  // const searchPopup = document.querySelector(".search-pop-up");
  
  // const closeSearch = searchPopup.querySelector(".close-search");
  const searchPopupBtn = document.querySelector(".search-submit");
  const searchPopup = document.querySelector(".search-pop-up");
  const searchClose = document.querySelector(".close-search");
  
  searchPopupBtn.addEventListener("click", () => {
    // searchPopup.style.display = 'flex';
    searchPopup.classList.add('search-open');
    document.querySelector('.search-field').focus();
  });

  searchClose.addEventListener("click", () => {
    searchPopup.classList.remove('search-open');
  });




})(jQuery);