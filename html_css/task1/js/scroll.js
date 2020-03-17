$(document).ready(function() {
    const urlHash = location.hash;
    if (urlHash) {
      $('body,html').stop().scrollTop(0);
      setTimeout(function () {
        scrollToAnker(urlHash) ;
      }, 100);
    }
  
    $('a[href^="#"]').on("click", function() {
      const href= $(this).attr("href");
      const hash = href == "#" || href == "" ? 'html' : href;
      scrollToAnker(hash);
      return false;
    });
  
    function scrollToAnker(hash) {
      const target = $(hash);
      const position = target.offset().top - 150;
      $('body,html').stop().animate({scrollTop:position}, 500);
    }
  });