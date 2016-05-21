(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $(document).ready(function() {
      $('select').material_select();
    });
  }); // end of document ready
})(jQuery); // end of jQuery name space

function idstanza() {
  
var e =document.getElementById('stanza');
var numstanza=e.options[e.selectedIndex].value;

return numstanza;
}

//funzione che scrolla la pagina nel checkinb
$(function () {
  $('#selectPiano').change(function () {
    $('html,body').animate({ scrollTop: $("#" + $(this).val()).offset().top-200 }, 800);  });
});

