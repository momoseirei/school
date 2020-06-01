$(function() {
  $(".modal-open").on("click", function() {
      $(this).blur();

      const username = $("#username").val();
      const email = $("#email").val();
      const sex = $("#sex:checked").val();
      const date = $("#date").val();

      $("#modal_username").text(username);
      $("#modal_email").text(email);
      $("#modal_sex").text(sex);
      $("#modal_date").text(date);

      if($("#modal-overlay")[0]) return false;
      $("body").append('<div id="modal-overlay"></div>');
      $("#modal-overlay").fadeIn("slow");
      centeringModalSyncer();
      $(".modal-content").fadeIn("slow");
      $("#modal-overlay, .modal-close").unbind().click(function() {
        $(".modal-content, #modal-overlay").fadeOut("slow", function() {
            $('#modal-overlay').remove();
        });
      });
  });

  $(window).resize(centeringModalSyncer);
  function centeringModalSyncer(){
      const w = $(window).width();
      const h = $(window).height();
      const cw = $(".modal-content").outerWidth();
      const ch = $(".modal-content").outerHeight();
      $(".modal-content").css({"left": ((w - cw)/2) + "px", "top": ((h - ch)/3) + "px"} );
      if (window.matchMedia( '(max-width: 767px)' ).matches) {
          $(".modal-content").css({"left": ((w - cw)/2) + "px", "top": ((h - ch)/3) + "px"} );
      }
  }
});